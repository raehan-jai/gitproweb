@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang, ' . auth()->user()->name)

@section('content')

{{-- Kartu Statistik --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card text-white" style="background: linear-gradient(135deg, #667eea, #764ba2);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 opacity-75">Total Kegiatan</p>
                        <h2 class="fw-bold mb-0">{{ $stats['kegiatan'] }}</h2>
                    </div>
                    <i class="bi bi-calendar-event" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card text-white" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 opacity-75">Total Peserta</p>
                        <h2 class="fw-bold mb-0">{{ $stats['peserta'] }}</h2>
                    </div>
                    <i class="bi bi-people" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card text-white" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 opacity-75">Total Sertifikat</p>
                        <h2 class="fw-bold mb-0">{{ $stats['sertifikat'] }}</h2>
                    </div>
                    <i class="bi bi-file-earmark-pdf" style="font-size: 2.5rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Kegiatan Terbaru --}}
<div class="card table-card">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2 text-primary"></i>Kegiatan Terbaru</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Penyelenggara</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatanTerbaru as $kegiatan)
                    <tr>
                        <td class="fw-semibold">{{ $kegiatan->nama_kegiatan }}</td>
                        <td>{{ $kegiatan->tanggal->format('d M Y') }}</td>
                        <td>{{ $kegiatan->penyelenggara }}</td>
                        <td>
                            <span class="badge bg-primary rounded-pill">
                                {{ $kegiatan->peserta->count() }} peserta
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">Belum ada kegiatan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection