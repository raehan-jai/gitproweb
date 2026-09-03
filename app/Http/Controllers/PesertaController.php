<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Kegiatan;
use App\Imports\PesertaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PesertaController extends Controller
{
    public function index()
    {
        $peserta = Peserta::with(['kegiatan', 'sertifikat'])
            ->latest()
            ->paginate(15);

        return view('peserta.index', compact('peserta'));
    }

    public function byKegiatan(Kegiatan $kegiatan)
    {
        $peserta = $kegiatan->peserta()
            ->with('sertifikat')
            ->latest()
            ->paginate(15);

        return view('peserta.by-kegiatan', compact('peserta', 'kegiatan'));
    }

    public function create()
    {
        $kegiatan = Kegiatan::all();
        return view('peserta.create', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'nama'        => 'required|string|max:255',
            'nis'         => 'nullable|string',
            'nisn'        => 'nullable|string',
            'kelas'       => 'nullable|string',
        ]);

        Peserta::create($request->all());
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan!');
    }

    public function edit(Peserta $peserta)
    {
        $kegiatan = Kegiatan::all();
        return view('peserta.edit', compact('peserta', 'kegiatan'));
    }

    public function update(Request $request, Peserta $peserta)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'nullable|string',
            'nisn'  => 'nullable|string',
            'kelas' => 'nullable|string',
        ]);

        $peserta->update($request->all());
        return redirect()->route('peserta.index')->with('success', 'Data peserta diperbarui!');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();
        return redirect()->route('peserta.index')->with('success', 'Peserta dihapus!');
    }

    // Import dari Excel/CSV
    public function import(Request $request)
    {
        $request->validate([
            'file'        => 'required|mimes:xlsx,xls,csv',
            'kegiatan_id' => 'required|exists:kegiatan,id',
        ]);
        

        Excel::import(new PesertaImport($request->kegiatan_id), $request->file('file'));

        return redirect()->route('peserta.index')->with('success', 'Import peserta berhasil!');
    }
}
