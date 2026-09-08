@extends('layouts.app')

@section('title', 'Buat Template')
@section('page-title', 'Buat Template Sertifikat')

@section('content')

<form action="{{ route('template-sertifikat.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row g-4">

    {{-- Kolom Kiri --}}
    <div class="col-md-6">

        {{-- Info Dasar --}}
        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-info-circle text-primary me-2"></i>Informasi Template</h6>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Template <span class="text-danger">*</span></label>
                    <input type="text" name="nama_template"
                           class="form-control @error('nama_template') is-invalid @enderror"
                           placeholder="Contoh: Template Lomba Sains 2025"
                           value="{{ old('nama_template') }}" required>
                    @error('nama_template')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Font Size Nama</label>
                        <div class="input-group">
                            <input type="number" name="font_size_nama" class="form-control"
                                   value="{{ old('font_size_nama', 28) }}" min="10" max="72">
                            <span class="input-group-text">pt</span>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Font Size Detail</label>
                        <div class="input-group">
                            <input type="number" name="font_size_detail" class="form-control"
                                   value="{{ old('font_size_detail', 11) }}" min="8" max="36">
                            <span class="input-group-text">pt</span>
                        </div>
                    </div>
                </div>

                @php
                    $perataanSaatIni = old('perataan_teks', 'kiri');
                @endphp
                <div class="mb-0">
                    <label class="form-label fw-semibold d-block">Perataan Teks</label>
                    <div class="btn-group" role="group" aria-label="Perataan Teks">

                        <input type="radio" class="btn-check" name="perataan_teks" id="perataanKiri"
                               value="kiri" autocomplete="off" {{ $perataanSaatIni === 'kiri' ? 'checked' : '' }}>
                        <label class="btn btn-outline-secondary" for="perataanKiri" title="Rata Kiri">
                            <i class="bi bi-text-left"></i>
                        </label>

                        <input type="radio" class="btn-check" name="perataan_teks" id="perataanTengah"
                               value="tengah" autocomplete="off" {{ $perataanSaatIni === 'tengah' ? 'checked' : '' }}>
                        <label class="btn btn-outline-secondary" for="perataanTengah" title="Rata Tengah">
                            <i class="bi bi-text-center"></i>
                        </label>

                        <input type="radio" class="btn-check" name="perataan_teks" id="perataanKanan"
                               value="kanan" autocomplete="off" {{ $perataanSaatIni === 'kanan' ? 'checked' : '' }}>
                        <label class="btn btn-outline-secondary" for="perataanKanan" title="Rata Kanan">
                            <i class="bi bi-text-right"></i>
                        </label>

                    </div>
                    <small class="text-muted d-block mt-1">Menentukan perataan nama peserta &amp; detail pada sertifikat.</small>
                </div>
            </div>
        </div>

        {{-- Background --}}
        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-image text-success me-2"></i>Background Sertifikat</h6>
            </div>
            <div class="card-body p-4">
                <input type="file" name="background" class="form-control" accept=".jpg,.jpeg,.png" id="inputBg">
                <small class="text-muted d-block mt-1">JPG/PNG, maks 10MB. Maksimal/rekomendasi: 1123x794px (A4 landscape).</small>
                <div id="previewBg" class="mt-3 d-none">
                    <img id="previewBgImg" src="" class="img-fluid rounded-3 shadow-sm" style="max-height:180px;" alt="Preview">
                </div>
            </div>
        </div>

        {{-- Logo Sekolah --}}
        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-building text-primary me-2"></i>Logo Sekolah</h6>
            </div>
            <div class="card-body p-4">
                <input type="file" name="logo_sekolah" class="form-control" accept=".jpg,.jpeg,.png" id="inputLogoSekolah">
                <small class="text-muted d-block mt-1">JPG/PNG, maks 2MB. Rekomendasi: 300x300px agar logo tetap tajam.</small>
                <div id="previewLogoSekolah" class="mt-3 d-none">
                    <img id="previewLogoSekolahImg" src="" class="img-fluid rounded-3 border p-2 bg-white" style="max-height:110px;" alt="Preview Logo">
                </div>
            </div>
        </div>

    </div>

    {{-- Kolom Kanan --}}
    <div class="col-md-6">

        {{-- TTD Kepala Sekolah --}}
        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-pen text-warning me-2"></i>Tanda Tangan Kepala Sekolah</h6>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kepala Sekolah</label>
                    <input type="text" name="nama_kepsek" class="form-control"
                           placeholder="Drs. Budi Santoso, M.Pd"
                           value="{{ old('nama_kepsek') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIP</label>
                    <input type="text" name="nip_kepsek" class="form-control"
                           placeholder="19700101 199903 1 001"
                           value="{{ old('nip_kepsek') }}">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold">Upload Tanda Tangan</label>
                    <input type="file" name="ttd_kepsek" class="form-control" accept=".jpg,.jpeg,.png" id="inputTtdKepsek">
                    <small class="text-muted">Gunakan gambar TTD dengan background transparan (PNG)</small>
                    <div id="previewTtdKepsek" class="mt-2 d-none">
                        <img id="previewTtdKepsekImg" src="" class="img-fluid rounded-2 border" style="max-height:80px; background: repeating-linear-gradient(45deg,#f0f0f0,#f0f0f0 5px,#fff 5px,#fff 10px);" alt="TTD">
                    </div>
                </div>
            </div>
        </div>

        {{-- TTD Panitia --}}
        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-pen text-info me-2"></i>Tanda Tangan Ketua Panitia</h6>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ketua Panitia</label>
                    <input type="text" name="nama_panitia" class="form-control"
                           placeholder="Siti Rahayu, S.Pd"
                           value="{{ old('nama_panitia') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIP</label>
                    <input type="text" name="nip_panitia" class="form-control"
                           placeholder="19850215 201001 2 002"
                           value="{{ old('nip_panitia') }}">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold">Upload Tanda Tangan</label>
                    <input type="file" name="ttd_panitia" class="form-control" accept=".jpg,.jpeg,.png" id="inputTtdPanitia">
                    <small class="text-muted">Gunakan gambar TTD dengan background transparan (PNG)</small>
                    <div id="previewTtdPanitia" class="mt-2 d-none">
                        <img id="previewTtdPanitiaImg" src="" class="img-fluid rounded-2 border" style="max-height:80px; background: repeating-linear-gradient(45deg,#f0f0f0,#f0f0f0 5px,#fff 5px,#fff 10px);" alt="TTD">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Tombol --}}
<div class="d-flex gap-2 mt-2">
    <button type="submit" class="btn btn-primary px-5 fw-semibold">
        <i class="bi bi-check-circle me-2"></i> Simpan Template
    </button>
    <a href="{{ route('template-sertifikat.index') }}" class="btn btn-light px-4">Batal</a>
</div>

</form>

@endsection

@push('scripts')
<script>
    function previewImage(inputId, previewContainerId, previewImgId) {
        document.getElementById(inputId).addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById(previewImgId).src = ev.target.result;
                document.getElementById(previewContainerId).classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        });
    }

    previewImage('inputBg', 'previewBg', 'previewBgImg');
    previewImage('inputLogoSekolah', 'previewLogoSekolah', 'previewLogoSekolahImg');
    previewImage('inputTtdKepsek', 'previewTtdKepsek', 'previewTtdKepsekImg');
    previewImage('inputTtdPanitia', 'previewTtdPanitia', 'previewTtdPanitiaImg');
</script>
@endpush
