@extends('layouts.app')

@section('title', 'Kegiatan')
@section('page-title', 'Manajemen Kegiatan')

@section('content')

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('kegiatan.create') }}" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-circle me-2"></i> Tambah Kegiatan
    </a>
</div>

<div class="card table-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Penyelenggara</th>
                        <th>Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->nama_kegiatan }}</td>
                        <td>{{ $item->tanggal->format('d M Y') }}</td>
                        <td>{{ $item->penyelenggara }}</td>
                        <td><span class="badge bg-info rounded-pill">{{ $item->peserta->count() }}</span></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('kegiatan.show', $item) }}" class="btn btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('kegiatan.edit', $item) }}" class="btn btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('kegiatan.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus kegiatan ini?')">
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
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-calendar-x" style="font-size: 3rem;"></i>
                            <p class="mt-2">Belum ada kegiatan. <a href="{{ route('kegiatan.create') }}">Tambah sekarang</a></p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $kegiatan->links() }}
    </div>
</div>

@endsection