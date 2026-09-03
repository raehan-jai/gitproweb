<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Peserta;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'kegiatan'   => Kegiatan::count(),
            'peserta'    => Peserta::count(),
            'sertifikat' => Sertifikat::count(),
        ];

        // Kegiatan terbaru
        $kegiatanTerbaru = Kegiatan::latest()->take(5)->get();

        return view('dashboard.index', compact('stats', 'kegiatanTerbaru', 'user'));
    }
}