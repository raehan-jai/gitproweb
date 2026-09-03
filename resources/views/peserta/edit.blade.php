@extends('layouts.app')

@section('title', 'Edit Peserta')
@section('page-title', 'Edit Data Peserta')
@section('page-subtitle', $peserta->nama)

@section('content')

<div class="card table-card">
    <div class="card-body p-4">
        <form action="{{ route('peserta.update', $peserta) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Kegiatan <span class="text-danger">*</span></label>
                <select name="kegiatan_id" class="form-select @error('kegiatan_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kegiatan --</option>
                    @foreach($kegiatan as $item)
                        <option value="{{ $item->id }}"
                            {{ old('kegiatan_id', $peserta->kegiatan_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kegiatan }}
                        </option>
                    @endforeach
                </select>
                @error('kegiatan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $peserta->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NIS</label>
                    <input type="text" name="nis" class="form-control"
                           value="{{ old('nis', $peserta->nis) }}"
                           placeholder="Nomor Induk Siswa">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NISN</label>
                    <input type="text" name="nisn" class="form-control"
                           value="{{ old('nisn', $peserta->nisn) }}"
                           placeholder="Nomor Induk Siswa Nasional">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Kelas</label>
                <input type="text" name="kelas" class="form-control"
                       value="{{ old('kelas', $peserta->kelas) }}"
                       placeholder="Contoh: XII IPA 1">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4 fw-semibold">
                    <i class="bi bi-save me-2"></i> Simpan Perubahan
                </button>
                <a href="{{ route('peserta.index') }}" class="btn btn-light px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection