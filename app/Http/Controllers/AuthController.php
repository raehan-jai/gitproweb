<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                             ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function showRegister()
    {
        // Kirim daftar kegiatan ke form register
        $kegiatan = Kegiatan::latest()->get();
        return view('auth.register', compact('kegiatan'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:6|confirmed',
            'role'        => 'required|in:admin,guru,siswa',
            'nis'         => 'nullable|string|max:50',
            'nisn'        => 'nullable|string|max:50',
            'kelas'       => 'nullable|string|max:50',
            'kegiatan_id' => 'nullable|exists:kegiatan,id',
        ]);

        // Buat akun user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Jika role siswa → otomatis buat data peserta
        if ($request->role === 'siswa') {
            $this->buatDataPeserta($user, $request);
        }

        return redirect()->route('login')
                         ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Helper: buat data peserta otomatis saat register
    private function buatDataPeserta(User $user, Request $request): void
    {
        // Jika siswa pilih kegiatan tertentu
        if ($request->filled('kegiatan_id')) {
            // Cek apakah sudah terdaftar di kegiatan ini
            $sudahAda = Peserta::where('kegiatan_id', $request->kegiatan_id)
                               ->where('nis', $request->nis ?? '')
                               ->exists();

            if (!$sudahAda) {
                Peserta::create([
                    'kegiatan_id' => $request->kegiatan_id,
                    'user_id'     => $user->id,  
                    'nama'        => $user->name,
                    'nis'         => $request->nis,
                    'nisn'        => $request->nisn,
                    'kelas'       => $request->kelas,
                ]);
            }
        } else {
            // Jika tidak pilih kegiatan, daftarkan ke SEMUA kegiatan yang ada
            $semuaKegiatan = Kegiatan::all();

            foreach ($semuaKegiatan as $kegiatan) {
                $sudahAda = Peserta::where('kegiatan_id', $kegiatan->id)
                                   ->where('nama', $user->name)
                                   ->exists();

                if (!$sudahAda) {
                    Peserta::create([
                        'kegiatan_id' => $kegiatan->id,
                        'nama'        => $user->name,
                        'nis'         => $request->nis,
                        'nisn'        => $request->nisn,
                        'kelas'       => $request->kelas,
                    ]);
                }
            }
        }
    }
}