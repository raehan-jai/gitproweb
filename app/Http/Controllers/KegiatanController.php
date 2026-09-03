<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    // Tampilkan semua kegiatan
    public function index()
    {
        $kegiatan = Kegiatan::with('user')->latest()->paginate(10);
        return view('kegiatan.index', compact('kegiatan'));
    }

    // Form tambah kegiatan
    public function create()
    {
        return view('kegiatan.create');
    }

    // Simpan kegiatan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal'       => 'required|date_format:d-m-Y',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'required|string|max:255',
        ]);

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'       => Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d'),
            'deskripsi'     => $request->deskripsi,
            'penyelenggara' => $request->penyelenggara,
            'user_id'       => Auth::id(),
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // Detail kegiatan
    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('peserta', 'sertifikat');
        return view('kegiatan.show', compact('kegiatan'));
    }

    // Form edit kegiatan
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    // Update kegiatan
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal'       => 'required|date_format:d-m-Y',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'required|string|max:255',
        ]);

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'       => Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d'),
            'deskripsi'     => $request->deskripsi,
            'penyelenggara' => $request->penyelenggara,
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    // Hapus kegiatan
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
