@extends('layouts.app')

@section('title', 'Tambah Kegiatan')
@section('page-title', 'Tambah Kegiatan Baru')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')

<div class="card table-card">
    <div class="card-body p-4">
        <form action="{{ route('kegiatan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="nama_kegiatan" class="form-control @error('nama_kegiatan') is-invalid @enderror"
                       placeholder="Contoh: Lomba Sains Tingkat Kabupaten" value="{{ old('nama_kegiatan') }}" required>
                @error('nama_kegiatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                <input type="text" name="tanggal" class="form-control datepicker @error('tanggal') is-invalid @enderror"
                       placeholder="dd-mm-yyyy" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Penyelenggara <span class="text-danger">*</span></label>
                <input type="text" name="penyelenggara" class="form-control"
                       placeholder="Nama sekolah/institusi" value="{{ old('penyelenggara') }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"
                          placeholder="Deskripsi singkat kegiatan...">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-circle me-2"></i> Simpan
                </button>
                <a href="{{ route('kegiatan.index') }}" class="btn btn-light px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    flatpickr('.datepicker', {
        dateFormat: 'd-m-Y',
        locale: 'id',
        allowInput: true
    });
</script>
@endpush
