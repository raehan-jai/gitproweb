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

{{-- Live Preview --}}
<div class="card table-card mt-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold"><i class="bi bi-eye text-primary me-2"></i>Live Preview Sertifikat</h6>
        <small class="text-muted">Perubahan form tampil secara langsung</small>
    </div>
    <div class="card-body p-3 p-md-4 bg-light">
        <div class="certificate-preview-shell mx-auto">
            <div id="certificatePreview" class="certificate-preview">
                <img id="certificatePreviewBg" class="certificate-preview-bg" src="{{ $templateSertifikat->background_path ? Storage::url($templateSertifikat->background_path) : '' }}" alt="">
                <div class="certificate-preview-content">
                    <img id="certificatePreviewLogo" data-preview-element="logo-sekolah" class="certificate-preview-logo {{ $templateSertifikat->logo_sekolah_path ? '' : 'd-none' }}" src="{{ $templateSertifikat->logo_sekolah_path ? Storage::url($templateSertifikat->logo_sekolah_path) : '' }}" alt="Logo Sekolah">
                    <div class="certificate-preview-label">Penghargaan &nbsp; Prestasi</div>
                    <div class="certificate-preview-title">Sertifikat</div>
                    <hr class="certificate-preview-title-line">
                    <div class="certificate-preview-given">Diberikan kepada</div>
                    <div id="certificatePreviewNama" data-preview-element="nama" class="certificate-preview-name">Nama Peserta</div>
                    <div class="certificate-preview-recipient">Kelas Peserta &nbsp;&bull;&nbsp; NIS: 00000000</div>
                    <hr class="certificate-preview-name-line">
                    <div class="certificate-preview-participation">atas partisipasi dan dedikasi dalam kegiatan</div>
                    <div id="certificatePreviewKegiatan" data-preview-element="detail-kegiatan" class="certificate-preview-activity">&ldquo;Nama Kegiatan&rdquo;</div>
                    <div class="certificate-preview-event-detail">Tanggal Kegiatan &nbsp;&bull;&nbsp; Penyelenggara</div>
                    <div class="certificate-preview-signatures">
                        <div data-preview-element="ttd-kepsek" class="certificate-preview-signature">
                            <div class="certificate-preview-signature-image-wrap"><img id="certificatePreviewTtdKepsek" class="certificate-preview-signature-image {{ $templateSertifikat->ttd_kepsek_path ? '' : 'd-none' }}" src="{{ $templateSertifikat->ttd_kepsek_path ? Storage::url($templateSertifikat->ttd_kepsek_path) : '' }}" alt="TTD Kepala Sekolah"></div>
                            <div class="certificate-preview-signature-line"></div><div class="certificate-preview-role">Kepala Sekolah</div>
                            <div id="certificatePreviewNamaKepsek" class="certificate-preview-signature-name">{{ old('nama_kepsek', $templateSertifikat->nama_kepsek) }}</div>
                            <div id="certificatePreviewNipKepsek" class="certificate-preview-nip">{{ old('nip_kepsek', $templateSertifikat->nip_kepsek) ? 'NIP. ' . old('nip_kepsek', $templateSertifikat->nip_kepsek) : '' }}</div>
                        </div>
                        <div data-preview-element="ttd-panitia" class="certificate-preview-signature">
                            <div class="certificate-preview-signature-image-wrap"><img id="certificatePreviewTtdPanitia" class="certificate-preview-signature-image {{ $templateSertifikat->ttd_panitia_path ? '' : 'd-none' }}" src="{{ $templateSertifikat->ttd_panitia_path ? Storage::url($templateSertifikat->ttd_panitia_path) : '' }}" alt="TTD Ketua Panitia"></div>
                            <div class="certificate-preview-signature-line"></div><div class="certificate-preview-role">Ketua Panitia</div>
                            <div id="certificatePreviewNamaPanitia" class="certificate-preview-signature-name">{{ old('nama_panitia', $templateSertifikat->nama_panitia) }}</div>
                            <div id="certificatePreviewNipPanitia" class="certificate-preview-nip">{{ old('nip_panitia', $templateSertifikat->nip_panitia) ? 'NIP. ' . old('nip_panitia', $templateSertifikat->nip_panitia) : '' }}</div>
                        </div>
                    </div>
                    <div class="certificate-preview-number">NO. SERTIFIKAT : PREVIEW</div>
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
<style>
    .certificate-preview-shell { max-width: 1123px; }
    .certificate-preview { position: relative; aspect-ratio: 297 / 210; overflow: hidden; background: #fff; box-shadow: 0 .5rem 1rem rgba(0,0,0,.15); font-family: Georgia, 'Times New Roman', serif; }
    .certificate-preview-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; }
    .certificate-preview-content { position: relative; z-index: 2; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 6% 13%; text-align: center; color: #444; }
    .certificate-preview-logo { max-width: 7%; max-height: 14%; object-fit: contain; margin-bottom: .5%; }
    .certificate-preview-label { font-size: clamp(5px, .67vw, 10px); color: #555; letter-spacing: .55em; text-transform: uppercase; margin-bottom: .5%; }
    .certificate-preview-title { font-size: clamp(20px, 3.1vw, 45px); line-height: 1; color: #8b6914; font-weight: bold; letter-spacing: .3em; text-transform: uppercase; margin-left: .3em; }
    .certificate-preview-title-line { width: 16%; border: 0; border-top: 1.5px solid #c8a000; margin: 1.2% 0; opacity: 1; }
    .certificate-preview-given { font-size: clamp(6px, .8vw, 12px); color: #555; font-style: italic; margin-bottom: .5%; }
    .certificate-preview-name { font-weight: bold; color: #1a3a6e; line-height: 1.2; }
    .certificate-preview-recipient { font-size: clamp(5px, .72vw, 10px); color: #666; margin: .5% 0 1%; }
    .certificate-preview-name-line { width: 40%; border: 0; border-top: 1px solid #bbb; margin: 0 0 1%; opacity: 1; }
    .certificate-preview-participation { font-size: clamp(5px, .72vw, 10px); margin-bottom: .4%; }
    .certificate-preview-activity { font-weight: bold; color: #1e3a5f; line-height: 1.2; }
    .certificate-preview-event-detail { font-size: clamp(5px, .65vw, 9px); color: #666; margin: .5% 0 2%; }
    .certificate-preview-signatures { display: flex; width: 46%; justify-content: space-between; }
    .certificate-preview-signature { width: 45%; font-family: Arial, sans-serif; }
    .certificate-preview-signature-image-wrap { height: clamp(20px, 4vw, 45px); display: flex; align-items: flex-end; justify-content: center; }
    .certificate-preview-signature-image { max-width: 75%; max-height: 100%; object-fit: contain; }
    .certificate-preview-signature-line { border-top: 1px solid #333; margin-bottom: 2%; }
    .certificate-preview-role { font-size: clamp(5px, .67vw, 9px); font-weight: bold; color: #222; }
    .certificate-preview-signature-name { font-size: clamp(5px, .62vw, 8px); color: #333; text-decoration: underline; min-height: 1em; }
    .certificate-preview-nip { font-size: clamp(4px, .57vw, 7px); color: #555; min-height: 1em; }
    .certificate-preview-number { font-family: Arial, sans-serif; font-size: clamp(4px, .57vw, 7px); color: #666; letter-spacing: .1em; margin-top: 1.5%; }
</style>
<script>
    function previewImage(inputId, containerId, imgId, certificateImageId) {
        document.getElementById(inputId).addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById(imgId).src = ev.target.result;
                document.getElementById(containerId).classList.remove('d-none');
                const certificateImage = document.getElementById(certificateImageId);
                certificateImage.src = ev.target.result;
                certificateImage.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        });
    }
    previewImage('inputBg', 'previewBg', 'previewBgImg', 'certificatePreviewBg');
    previewImage('inputLogoSekolah', 'previewLogoSekolah', 'previewLogoSekolahImg', 'certificatePreviewLogo');
    previewImage('inputTtdKepsek', 'previewTtdKepsek', 'previewTtdKepsekImg', 'certificatePreviewTtdKepsek');
    previewImage('inputTtdPanitia', 'previewTtdPanitia', 'previewTtdPanitiaImg', 'certificatePreviewTtdPanitia');

    function bindPreviewText(inputName, previewId, formatter = value => value) {
        const input = document.querySelector(`[name="${inputName}"]`);
        const preview = document.getElementById(previewId);
        const update = () => preview.textContent = formatter(input.value.trim());
        input.addEventListener('input', update);
        update();
    }
    bindPreviewText('nama_template', 'certificatePreviewKegiatan', value => value ? `"${value}"` : '"Nama Kegiatan"');
    bindPreviewText('nama_kepsek', 'certificatePreviewNamaKepsek');
    bindPreviewText('nip_kepsek', 'certificatePreviewNipKepsek', value => value ? `NIP. ${value}` : '');
    bindPreviewText('nama_panitia', 'certificatePreviewNamaPanitia');
    bindPreviewText('nip_panitia', 'certificatePreviewNipPanitia', value => value ? `NIP. ${value}` : '');

    ['font_size_nama', 'font_size_detail'].forEach(name => {
        const input = document.querySelector(`[name="${name}"]`);
        const preview = document.getElementById(name === 'font_size_nama' ? 'certificatePreviewNama' : 'certificatePreviewKegiatan');
        const update = () => preview.style.fontSize = `${input.value || input.min}pt`;
        input.addEventListener('input', update);
        input.addEventListener('change', update);
        update();
    });

    // data-preview-element menjadi titik integrasi bagi state posisi drag/drop yang tersedia nanti.
</script>
@endpush
