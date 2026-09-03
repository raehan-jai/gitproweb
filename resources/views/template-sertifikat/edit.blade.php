@extends('layouts.app')

@section('title', 'Edit Template')
@section('page-title', 'Edit Template Sertifikat')
@section('page-subtitle', $templateSertifikat->nama_template)

@section('content')

<form action="{{ route('template-sertifikat.update', $templateSertifikat) }}"
      method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row g-4">

    {{-- Kolom Kiri --}}
    <div class="col-md-6">

        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-info-circle text-primary me-2"></i>Informasi Template</h6>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Template <span class="text-danger">*</span></label>
                    <input type="text" name="nama_template" class="form-control"
                           value="{{ old('nama_template', $templateSertifikat->nama_template) }}" required>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Font Size Nama</label>
                        <div class="input-group">
                            <input type="number" name="font_size_nama" class="form-control"
                                   value="{{ old('font_size_nama', $templateSertifikat->font_size_nama) }}"
                                   min="10" max="72">
                            <span class="input-group-text">pt</span>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Font Size Detail</label>
                        <div class="input-group">
                            <input type="number" name="font_size_detail" class="form-control"
                                   value="{{ old('font_size_detail', $templateSertifikat->font_size_detail) }}"
                                   min="8" max="36">
                            <span class="input-group-text">pt</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-image text-success me-2"></i>Background Sertifikat</h6>
            </div>
            <div class="card-body p-4">
                @if($templateSertifikat->background_path)
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Background saat ini:</small>
                    <img src="{{ Storage::url($templateSertifikat->background_path) }}"
                         class="img-fluid rounded-3 shadow-sm" style="max-height:120px;" alt="BG">
                </div>
                @endif
                <input type="file" name="background" class="form-control" accept=".jpg,.jpeg,.png" id="inputBg">
                <small class="text-muted d-block mt-1">JPG/PNG, maks 10MB. Maksimal/rekomendasi: 1123x794px (A4 landscape).</small>
                <div id="previewBg" class="mt-2 d-none">
                    <img id="previewBgImg" src="" class="img-fluid rounded-3 shadow-sm" style="max-height:120px;" alt="Preview">
                </div>
            </div>
        </div>

        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-building text-primary me-2"></i>Logo Sekolah</h6>
            </div>
            <div class="card-body p-4">
                @if($templateSertifikat->logo_sekolah_path)
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Logo saat ini:</small>
                    <img src="{{ Storage::url($templateSertifikat->logo_sekolah_path) }}"
                         class="img-fluid rounded-3 border p-2 bg-white" style="max-height:90px;" alt="Logo Sekolah">
                </div>
                @endif
                <input type="file" name="logo_sekolah" class="form-control" accept=".jpg,.jpeg,.png" id="inputLogoSekolah">
                <small class="text-muted d-block mt-1">JPG/PNG, maks 2MB. Rekomendasi: 300x300px agar logo tetap tajam.</small>
                <div id="previewLogoSekolah" class="mt-2 d-none">
                    <img id="previewLogoSekolahImg" src="" class="img-fluid rounded-3 border p-2 bg-white" style="max-height:90px;" alt="Preview Logo">
                </div>
            </div>
        </div>

    </div>

    {{-- Kolom Kanan --}}
    <div class="col-md-6">

        {{-- TTD Kepsek --}}
        <div class="card table-card mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-pen text-warning me-2"></i>Tanda Tangan Kepala Sekolah</h6>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kepala Sekolah</label>
                    <input type="text" name="nama_kepsek" class="form-control"
                           value="{{ old('nama_kepsek', $templateSertifikat->nama_kepsek) }}"
                           placeholder="Drs. Budi Santoso, M.Pd">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIP</label>
                    <input type="text" name="nip_kepsek" class="form-control"
                           value="{{ old('nip_kepsek', $templateSertifikat->nip_kepsek) }}"
                           placeholder="19700101 199903 1 001">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold">Tanda Tangan</label>
                    @if($templateSertifikat->ttd_kepsek_path)
                    <div class="mb-2">
                        <small class="text-muted d-block mb-1">TTD saat ini:</small>
                        <img src="{{ Storage::url($templateSertifikat->ttd_kepsek_path) }}"
                             class="img-fluid rounded-2 border" style="max-height:70px;" alt="TTD Kepsek">
                    </div>
                    @endif
                    <input type="file" name="ttd_kepsek" class="form-control" accept=".jpg,.jpeg,.png" id="inputTtdKepsek">
                    <small class="text-muted"></small>
                    <div id="previewTtdKepsek" class="mt-2 d-none">
                        <img id="previewTtdKepsekImg" src="" class="img-fluid rounded-2 border" style="max-height:70px;" alt="Preview">
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
                           value="{{ old('nama_panitia', $templateSertifikat->nama_panitia) }}"
                           placeholder="Siti Rahayu, S.Pd">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIP</label>
                    <input type="text" name="nip_panitia" class="form-control"
                           value="{{ old('nip_panitia', $templateSertifikat->nip_panitia) }}"
                           placeholder="19850215 201001 2 002">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold">Tanda Tangan</label>
                    @if($templateSertifikat->ttd_panitia_path)
                    <div class="mb-2">
                        <small class="text-muted d-block mb-1">TTD saat ini:</small>
                        <img src="{{ Storage::url($templateSertifikat->ttd_panitia_path) }}"
                             class="img-fluid rounded-2 border" style="max-height:70px;" alt="TTD Panitia">
                    </div>
                    @endif
                    <input type="file" name="ttd_panitia" class="form-control" accept=".jpg,.jpeg,.png" id="inputTtdPanitia">
                    <small class="text-muted"></small>
                    <div id="previewTtdPanitia" class="mt-2 d-none">
                        <img id="previewTtdPanitiaImg" src="" class="img-fluid rounded-2 border" style="max-height:70px;" alt="Preview">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="d-flex gap-2 mt-2">
    <button type="submit" class="btn btn-warning px-5 fw-semibold">
        <i class="bi bi-save me-2"></i> Simpan Perubahan
    </button>
    <a href="{{ route('template-sertifikat.index') }}" class="btn btn-light px-4">Batal</a>
</div>

</form>

@endsection

@push('scripts')
<script>
    function previewImage(inputId, containerId, imgId) {
        document.getElementById(inputId).addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById(imgId).src = ev.target.result;
                document.getElementById(containerId).classList.remove('d-none');
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
