@extends('layouts.app')

@section('title', 'Peserta')
@section('page-title', 'Manajemen Peserta')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex gap-2">
        {{-- Form Import Excel --}}
        <button class="btn btn-success rounded-3" data-bs-toggle="modal" data-bs-target="#modalImport">
            <i class="bi bi-file-earmark-excel me-2"></i> Import Excel
        </button>
    </div>
    <a href="{{ route('peserta.create') }}" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-circle me-2"></i> Tambah Peserta
    </a>
</div>

<div class="card table-card">
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
                        <th>Kegiatan</th>
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
                            <span class="badge bg-primary rounded-pill">
                                {{ $item->kegiatan->nama_kegiatan ?? '-' }}
                            </span>
                        </td>
                        <td>
                            @if($item->sertifikat)
                                <span class="badge bg-success rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i> Ada
                                </span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Belum</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('peserta.edit', $item) }}" class="btn btn-outline-warning">
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
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-people" style="font-size: 3rem;"></i>
                            <p class="mt-2">Belum ada peserta. <a href="{{ route('peserta.create') }}">Tambah sekarang</a></p>
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

{{-- Modal Import Excel --}}
<div class="modal fade" id="modalImport" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-file-earmark-excel text-success me-2"></i>Import Peserta dari Excel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('peserta.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Kegiatan <span class="text-danger">*</span></label>
                        <select name="kegiatan_id" class="form-select" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach(\App\Models\Kegiatan::all() as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kegiatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">File Excel/CSV <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                    </div>
                    <div class="alert alert-info rounded-3 small">
                        <i class="bi bi-info-circle me-2"></i>
                        Format kolom Excel: <strong>nama | nis | nisn | kelas</strong><br>
                        Baris pertama harus header kolom.
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-upload me-2"></i> Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
