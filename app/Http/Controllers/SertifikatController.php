<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Peserta;
use App\Models\Sertifikat;
use App\Models\TemplateSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::with(['peserta', 'kegiatan'])->latest()->paginate(15);
        $kegiatan   = Kegiatan::all();
        $template   = TemplateSertifikat::all();
        return view('sertifikat.index', compact('sertifikat', 'kegiatan', 'template'));
    }

    public function generate(Request $request, int $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'template_id' => 'required|exists:template_sertifikat,id',
        ]);

        $template    = TemplateSertifikat::findOrFail($request->template_id);
        $pesertaList = $kegiatan->peserta;

        if ($pesertaList->isEmpty()) {
            return back()->with('error', 'Tidak ada peserta dalam kegiatan ini!');
        }

        $generated = 0;
        $skipped   = 0;

        foreach ($pesertaList as $peserta) {
            $sertifikat = Sertifikat::where('peserta_id', $peserta->id)
                                    ->where('kegiatan_id', $kegiatan->id)
                                    ->first();

            if ($sertifikat) {
                $sertifikat->update(['template_id' => $template->id]);
                $this->buatPDF($sertifikat->id);
                $skipped++;
                continue;
            }

            try {
                $nomorSertifikat = $this->generateNomor();

                $sertifikat = Sertifikat::create([
                    'peserta_id'       => $peserta->id,
                    'kegiatan_id'      => $kegiatan->id,
                    'template_id'      => $template->id,
                    'nomor_sertifikat' => $nomorSertifikat,
                ]);

                $this->buatPDF($sertifikat->id);

                $generated++;

            } catch (\Exception $e) {
                Log::error('Gagal generate sertifikat: ' . $e->getMessage());
                continue;
            }
        }

        $pesan = $generated . ' sertifikat berhasil digenerate!';
        if ($skipped > 0) {
            $pesan .= ' ' . $skipped . ' sertifikat lama diperbarui dengan template yang dipilih.';
        }

        return back()->with('success', $pesan);
    }

    public function download(int $id)
    {
        // Load ulang dari database dengan semua relasi lengkap
        $sertifikat = Sertifikat::with([
            'peserta',
            'kegiatan',
            'template',
        ])->findOrFail($id);

        // Pastikan template benar-benar terload
        $template = TemplateSertifikat::findOrFail($sertifikat->template_id);

        $pdf = Pdf::loadView('sertifikat.pdf-template', [
            'sertifikat' => $sertifikat,
            'peserta'    => $sertifikat->peserta,
            'kegiatan'   => $sertifikat->kegiatan,
            'template'   => $template,
        ])->setPaper('a4', 'landscape');

        $filename = 'sertifikat-' . str_replace('/', '-', $sertifikat->nomor_sertifikat) . '.pdf';

        return $pdf->download($filename);
    }

    public function pdf(int $id)
    {
        $sertifikat = Sertifikat::with(['peserta', 'kegiatan', 'template'])->findOrFail($id);
        $template   = TemplateSertifikat::findOrFail($sertifikat->template_id);

        $pdf = Pdf::loadView('sertifikat.pdf-template', [
            'sertifikat' => $sertifikat,
            'peserta'    => $sertifikat->peserta,
            'kegiatan'   => $sertifikat->kegiatan,
            'template'   => $template,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('sertifikat.pdf');
    }

    public function milikSaya()
    {
        $user = Auth::user();

        $pesertaIds = Peserta::where('user_id', $user->id)->pluck('id');

        if ($pesertaIds->isEmpty()) {
            $pesertaIds = Peserta::where('nama', $user->name)->pluck('id');
        }

        $sertifikat = Sertifikat::whereIn('peserta_id', $pesertaIds)
                                 ->with(['peserta', 'kegiatan'])
                                 ->latest()
                                 ->paginate(10);

        return view('sertifikat.milik-saya', compact('sertifikat'));
    }

    public function destroy(int $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        if ($sertifikat->file_path && file_exists(storage_path('app/public/' . $sertifikat->file_path))) {
            unlink(storage_path('app/public/' . $sertifikat->file_path));
        }

        $sertifikat->delete();

        return back()->with('success', 'Sertifikat berhasil dihapus!');
    }

    private function generateNomor(): string
    {
        $tahun = date('Y');
        $bulan = date('m');

        $count = Sertifikat::whereYear('created_at', $tahun)
                           ->whereMonth('created_at', $bulan)
                           ->count();

        do {
            $count++;
            $urutan = str_pad($count, 3, '0', STR_PAD_LEFT);
            $nomor  = 'SERT/' . $tahun . '/' . $bulan . '/' . $urutan;
        } while (Sertifikat::where('nomor_sertifikat', $nomor)->exists());

        return $nomor;
    }

    private function buatPDF(int $sertifikatId): void
    {
        // Load fresh dari database agar semua relasi benar
        $sertifikat = Sertifikat::with(['peserta', 'kegiatan'])->findOrFail($sertifikatId);
        $template   = TemplateSertifikat::findOrFail($sertifikat->template_id);
        $peserta    = $sertifikat->peserta;
        $kegiatan   = $sertifikat->kegiatan;

        $pdf = Pdf::loadView('sertifikat.pdf-template', compact(
            'sertifikat',
            'peserta',
            'kegiatan',
            'template'
        ))->setPaper('a4', 'landscape');

        $folder = storage_path('app/public/sertifikat');
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $filename = 'sertifikat/' . str_replace('/', '-', $sertifikat->nomor_sertifikat) . '.pdf';
        $pdf->save(storage_path('app/public/' . $filename));
        $sertifikat->update(['file_path' => $filename]);
    }
}
