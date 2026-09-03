<?php

namespace App\Http\Controllers;

use App\Models\AccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountRequestController extends Controller
{
    // Admin: lihat semua request
    public function index()
    {
        $pending  = AccountRequest::where('status', 'pending')->latest()->get();
        $reviewed = AccountRequest::whereIn('status', ['approved', 'rejected'])->latest()->take(20)->get();
        return view('account-request.index', compact('pending', 'reviewed'));
    }

    // Form request akun guru (publik)
    public function create()
    {
        return view('account-request.create');
    }

    // Simpan request akun guru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email|unique:account_requests,email',
            'password' => 'required|min:6|confirmed',
            'jabatan'  => 'nullable|string|max:255',
            'alasan'   => 'nullable|string|max:500',
        ]);

        AccountRequest::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'jabatan'  => $request->jabatan,
            'alasan'   => $request->alasan,
            'status'   => 'pending',
        ]);

        return redirect()->route('account-request.success');
    }

    // Halaman sukses setelah request
    public function success()
    {
        return view('account-request.success');
    }

    // Admin: approve request
    public function approve(int $id)
    {
        $req = AccountRequest::findOrFail($id);

        if (!$req->isPending()) {
            return back()->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        // Buat akun user baru
        User::create([
            'name'     => $req->name,
            'email'    => $req->email,
            'password' => $req->password,
            'role'     => 'guru',
        ]);

        $req->update([
            'status'      => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Akun guru untuk ' . $req->name . ' berhasil disetujui!');
    }

    // Admin: reject request
    public function reject(Request $request, int $id)
    {
        $req = AccountRequest::findOrFail($id);

        if (!$req->isPending()) {
            return back()->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        $req->update([
            'status'        => 'rejected',
            'catatan_admin' => $request->catatan_admin,
            'reviewed_by'   => Auth::id(),
            'reviewed_at'   => now(),
        ]);

        return back()->with('success', 'Request akun ' . $req->name . ' telah ditolak.');
    }
}