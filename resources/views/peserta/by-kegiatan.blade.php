@extends('layouts.app')

@section('title', 'Peserta Kegiatan')
@section('page-title', 'Peserta Kegiatan')
@section('page-subtitle', $kegiatan->nama_kegiatan)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('kegiatan.show', $kegiatan) }}" class="btn btn-light rounded-3">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Detail Kegiatan
    </a>
    <a href="{{ route('peserta.create') }}" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-circle me-2"></i> Tambah Peserta
    </a>
</div>

<div class="card table-card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-people text-primary me-2"></i>
            Peserta: {{ $kegiatan->nama_kegiatan }}
        </h6>
        <span class="badge bg-primary rounded-pill">{{ $peserta->total() }} peserta</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Sertifikat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peserta as $item)
                    <tr>
                        <td>{{ $peserta->firstItem() + $loop->index }}</td>
                        <td class="fw-semibold">{{ $item->nama }}</td>
                        <td>{{ $item->nis ?? '-' }}</td>
                        <td>{{ $item->nisn ?? '-' }}</td>
                        <td>{{ $item->kelas ?? '-' }}</td>
                        <td>
                            @if($item->sertifikat)
                                <a href="{{ route('sertifikat.download', $item->sertifikat) }}"
                                   class="badge bg-success rounded-pill text-decoration-none">
                                    <i class="bi bi-download me-1"></i>Download
                                </a>
                            @else
                                <span class="badge bg-secondary rounded-pill">Belum ada</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('peserta.edit', $item) }}"
                                   class="btn btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('peserta.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus peserta ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-people" style="font-size:3rem;"></i>
                            <p class="mt-2">Belum ada peserta untuk kegiatan ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        @include('partials.pagination', ['paginator' => $peserta])
    </div>
</div>

@endsection
