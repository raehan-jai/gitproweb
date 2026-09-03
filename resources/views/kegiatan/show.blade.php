@extends('layouts.app')

@section('title', 'Detail Kegiatan')
@section('page-title', 'Detail Kegiatan')
@section('page-subtitle', $kegiatan->nama_kegiatan)

@section('content')

<div class="row g-4">

    {{-- Info Kegiatan --}}
    <div class="col-md-4">
        <div class="card table-card h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">
                    <i class="bi bi-info-circle text-primary me-2"></i>Informasi Kegiatan
                </h6>
            </div>
            <div class="card-body p-4">
                <dl class="row mb-0">
                    <dt class="col-sm-5 text-muted">Nama</dt>
                    <dd class="col-sm-7 fw-semibold">{{ $kegiatan->nama_kegiatan }}</dd>

                    <dt class="col-sm-5 text-muted">Tanggal</dt>
                    <dd class="col-sm-7">{{ $kegiatan->tanggal->format('d M Y') }}</dd>

                    <dt class="col-sm-5 text-muted">Penyelenggara</dt>
                    <dd class="col-sm-7">{{ $kegiatan->penyelenggara }}</dd>

                    <dt class="col-sm-5 text-muted">Dibuat oleh</dt>
                    <dd class="col-sm-7">{{ $kegiatan->user->name ?? '-' }}</dd>

                    <dt class="col-sm-5 text-muted">Deskripsi</dt>
                    <dd class="col-sm-7">{{ $kegiatan->deskripsi ?? '-' }}</dd>
                </dl>
            </div>
            <div class="card-footer bg-white border-0 pb-4 px-4">
                <div class="d-flex gap-2">
                    <a href="{{ route('kegiatan.edit', $kegiatan) }}"
                       class="btn btn-warning btn-sm flex-fill">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('kegiatan.index') }}"
                       class="btn btn-light btn-sm flex-fill">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Peserta --}}
    <div class="col-md-8">
        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">
                    <i class="bi bi-people text-success me-2"></i>
                    Daftar Peserta
                    <span class="badge bg-success rounded-pill ms-1">{{ $kegiatan->peserta->count() }}</span>
                </h6>
                <a href="{{ route('peserta.create') }}" class="btn btn-sm btn-outline-success">
                    <i class="bi bi-plus me-1"></i> Tambah
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatan->peserta as $peserta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $peserta->nama }}</td>
                                <td>{{ $peserta->nis ?? '-' }}</td>
                                <td>{{ $peserta->kelas ?? '-' }}</td>
                                <td>
                                    @if($peserta->sertifikat)
                                        <span class="badge bg-success rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i>Sudah
                                        </span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">Belum</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-people" style="font-size:2rem;"></i>
                                    <p class="mt-2 mb-0">Belum ada peserta</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Statistik Sertifikat --}}
        <div class="row g-3">
            <div class="col-6">
                <div class="card stat-card text-white"
                     style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                    <div class="card-body p-3 d-flex align-items-center gap-3">
                        <i class="bi bi-people-fill" style="font-size:2rem; opacity:.6;"></i>
                        <div>
                            <small class="opacity-75">Total Peserta</small>
                            <h3 class="mb-0 fw-bold">{{ $kegiatan->peserta->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card stat-card text-white"
                     style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                    <div class="card-body p-3 d-flex align-items-center gap-3">
                        <i class="bi bi-file-earmark-pdf-fill" style="font-size:2rem; opacity:.6;"></i>
                        <div>
                            <small class="opacity-75">Sertifikat Digenerate</small>
                            <h3 class="mb-0 fw-bold">{{ $kegiatan->sertifikat->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection