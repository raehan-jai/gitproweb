@extends('layouts.app')

@section('title', 'Buat Template')
@section('page-title', 'Buat Template Sertifikat')

@section('content')

@php
    $textsDefault = [
        'eyebrow' => 'PENGHARGAAN     PELATIHAN',
        'title' => 'SERTIFIKAT',
        'given_to' => 'Diberikan kepada',
        'participant_name' => 'Nama Peserta',
        'participant_info' => 'Kelas Peserta - NIS: 000000000',
        'participation_text' => 'atas partisipasi dan dedikasi dalam kegiatan',
        'activity_name' => '"LDKS Osis"',
        'activity_detail' => 'Tanggal Kegiatan - Penyelenggara',
        'principal_title' => 'Kepala Sekolah',
        'principal_name' => old('nama_kepsek', 'Nama Kepala Sekolah'),
        'principal_nip' => old('nip_kepsek') ? 'NIP. ' . old('nip_kepsek') : 'NIP. 000000000000000000',
        'committee_title' => 'Ketua Panitia',
        'committee_name' => old('nama_panitia', 'Nama Ketua Panitia'),
        'committee_nip' => old('nip_panitia') ? 'NIP. ' . old('nip_panitia') : 'NIP. 000000000000000000',
        'certificate_number' => 'NO. SERTIFIKAT : PREVIEW',
    ];

    $positionsDefault = [
        'logo' => ['x' => 50, 'y' => 7],
        'eyebrow' => ['x' => 50, 'y' => 12],
        'title' => ['x' => 50, 'y' => 20],
        'given_to' => ['x' => 50, 'y' => 30],
        'participant_name' => ['x' => 50, 'y' => 37],
        'participant_info' => ['x' => 50, 'y' => 43],
        'participation_text' => ['x' => 50, 'y' => 51],
        'activity_name' => ['x' => 50, 'y' => 57],
        'activity_detail' => ['x' => 50, 'y' => 63],
        'ttd_kepsek' => ['x' => 39, 'y' => 71],
        'principal_title' => ['x' => 39, 'y' => 76],
        'principal_name' => ['x' => 39, 'y' => 80],
        'principal_nip' => ['x' => 39, 'y' => 84],
        'ttd_panitia' => ['x' => 61, 'y' => 71],
        'committee_title' => ['x' => 61, 'y' => 76],
        'committee_name' => ['x' => 61, 'y' => 80],
        'committee_nip' => ['x' => 61, 'y' => 84],
        'certificate_number' => ['x' => 50, 'y' => 90],
    ];

    $stylesDefault = [
        'eyebrow' => ['font_size' => 14],
        'title' => ['font_size' => 48],
        'given_to' => ['font_size' => 17],
        'participant_name' => ['font_size' => (int) old('font_size_nama', 28) * 1.45],
        'participant_info' => ['font_size' => (int) old('font_size_detail', 14) * 1.05],
        'participation_text' => ['font_size' => (int) old('font_size_detail', 14) * 1.05],
        'activity_name' => ['font_size' => (int) old('font_size_detail', 14) * 1.75],
        'activity_detail' => ['font_size' => (int) old('font_size_detail', 14) * 1.05],
        'principal_title' => ['font_size' => 13],
        'principal_name' => ['font_size' => 12],
        'principal_nip' => ['font_size' => (int) old('font_size_detail', 14) * 1.05],
        'committee_title' => ['font_size' => 13],
        'committee_name' => ['font_size' => 12],
        'committee_nip' => ['font_size' => (int) old('font_size_detail', 14) * 1.05],
        'certificate_number' => ['font_size' => (int) old('font_size_detail', 14) * 1.05],
    ];

    $texts = array_merge($textsDefault, is_array(old('certificate_texts')) ? old('certificate_texts') : []);
    $positions = array_replace_recursive($positionsDefault, is_array(old('element_positions')) ? old('element_positions') : []);
    $styles = array_replace_recursive($stylesDefault, is_array(old('element_styles')) ? old('element_styles') : []);
    $perataanSaatIni = old('perataan_teks', 'tengah');
@endphp

<form action="{{ route('template-sertifikat.store') }}" method="POST" enctype="multipart/form-data" id="templateEditorForm">
@csrf

<div class="card table-card template-preview-card">
    <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
        <h6 class="mb-0 fw-bold"><i class="bi bi-eye text-primary me-2"></i>Live Preview Sertifikat</h6>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="text-muted small">Tekan Edit untuk mengisi template</span>
            <button type="button" class="btn btn-primary btn-sm fw-semibold" id="openEditor">
                <i class="bi bi-pencil-square me-1"></i>Edit
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm fw-semibold" id="resetPositions">
                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset Posisi
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm fw-semibold" id="moveAllUp">
                <i class="bi bi-arrow-up me-1"></i>Naik
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm fw-semibold" id="moveAllDown">
                <i class="bi bi-arrow-down me-1"></i>Turun
            </button>
            <button type="submit" class="btn btn-primary btn-sm fw-semibold">
                <i class="bi bi-check-circle me-1"></i>Simpan
            </button>
            <a href="{{ route('template-sertifikat.index') }}" class="btn btn-light btn-sm">Batal</a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="template-editor-wrap">
            <aside class="editor-drawer" id="editorDrawer">
                <div class="editor-drawer-header">
                    <div>
                        <h6 class="mb-0 fw-bold">Form Buat Template</h6>
                        <small class="text-muted">Form ini bisa digeser dari bagian header.</small>
                    </div>
                    <button type="button" class="btn btn-light btn-sm" id="closeEditor" title="Tutup form">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="editor-drawer-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Template <span class="text-danger">*</span></label>
                        <input type="text" name="nama_template" class="form-control @error('nama_template') is-invalid @enderror"
                               placeholder="Contoh: Template Lomba Sains 2026" value="{{ old('nama_template') }}" required>
                        @error('nama_template')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">Font Teks Dipilih</label>
                            <div class="input-group">
                                <input type="number" id="selectedFontSize" class="form-control" value="48" min="6" max="120" step="1">
                                <span class="input-group-text">px</span>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">Teks Terpilih</label>
                            <input type="text" id="selectedElementLabel" class="form-control" value="Title" readonly>
                        </div>
                    </div>
                    <input type="hidden" name="font_size_nama" value="{{ old('font_size_nama', 28) }}">
                    <input type="hidden" name="font_size_detail" value="{{ old('font_size_detail', 14) }}">

                    <div class="mb-3">
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
                    </div>

                    <div class="accordion mb-3" id="editorAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#textFields">
                                    Isi Tulisan Sertifikat
                                </button>
                            </h2>
                            <div id="textFields" class="accordion-collapse collapse show" data-bs-parent="#editorAccordion">
                                <div class="accordion-body">
                                    @foreach($texts as $key => $value)
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">{{ \Illuminate\Support\Str::headline($key) }}</label>
                                            <textarea name="certificate_texts[{{ $key }}]" class="form-control js-text-field"
                                                      rows="2" data-target="{{ $key }}">{{ $value }}</textarea>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#imageFields">
                                    Gambar dan Tanda Tangan
                                </button>
                            </h2>
                            <div id="imageFields" class="accordion-collapse collapse" data-bs-parent="#editorAccordion">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Background Sertifikat</label>
                                        <input type="file" name="background" class="form-control" accept=".jpg,.jpeg,.png" id="inputBg">
                                        <button type="button" class="btn btn-outline-danger btn-sm mt-2 js-remove-image"
                                                data-input="inputBg" data-image="previewBgImg">
                                            <i class="bi bi-trash me-1"></i>Hapus Background
                                        </button>
                                        <small class="text-muted d-block mt-1">JPG/PNG, maks 10MB. Rekomendasi 1123x794px.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Logo Sekolah</label>
                                        <input type="file" name="logo_sekolah" class="form-control" accept=".jpg,.jpeg,.png" id="inputLogoSekolah">
                                        <button type="button" class="btn btn-outline-danger btn-sm mt-2 js-remove-image"
                                                data-input="inputLogoSekolah" data-image="previewLogoSekolahImg">
                                            <i class="bi bi-trash me-1"></i>Hapus Logo
                                        </button>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Tanda Tangan Kepala Sekolah</label>
                                        <input type="file" name="ttd_kepsek" class="form-control" accept=".jpg,.jpeg,.png" id="inputTtdKepsek">
                                        <button type="button" class="btn btn-outline-danger btn-sm mt-2 js-remove-image"
                                                data-input="inputTtdKepsek" data-image="previewTtdKepsekImg" data-fallback="TTD Kepala Sekolah">
                                            <i class="bi bi-trash me-1"></i>Hapus TTD Kepala Sekolah
                                        </button>
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label fw-semibold">Tanda Tangan Ketua Panitia</label>
                                        <input type="file" name="ttd_panitia" class="form-control" accept=".jpg,.jpeg,.png" id="inputTtdPanitia">
                                        <button type="button" class="btn btn-outline-danger btn-sm mt-2 js-remove-image"
                                                data-input="inputTtdPanitia" data-image="previewTtdPanitiaImg" data-fallback="TTD Ketua Panitia">
                                            <i class="bi bi-trash me-1"></i>Hapus TTD Ketua Panitia
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#legacyFields">
                                    Data Kepala Sekolah dan Panitia
                                </button>
                            </h2>
                            <div id="legacyFields" class="accordion-collapse collapse" data-bs-parent="#editorAccordion">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Kepala Sekolah</label>
                                        <input type="text" name="nama_kepsek" class="form-control" value="{{ old('nama_kepsek') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">NIP Kepala Sekolah</label>
                                        <input type="text" name="nip_kepsek" class="form-control" value="{{ old('nip_kepsek') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Ketua Panitia</label>
                                        <input type="text" name="nama_panitia" class="form-control" value="{{ old('nama_panitia') }}">
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label fw-semibold">NIP Ketua Panitia</label>
                                        <input type="text" name="nip_panitia" class="form-control" value="{{ old('nip_panitia') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-check-circle me-2"></i>Simpan Template
                    </button>
                </div>
            </aside>

            <div class="preview-scroll">
                <div class="certificate-canvas" id="certificateCanvas">
                    <img src="" class="certificate-bg d-none" id="previewBgImg" alt="Background">
                    <img src="" class="canvas-item logo-item d-none" id="previewLogoSekolahImg" data-element="logo" alt="Logo Sekolah"
                         style="left: {{ $positions['logo']['x'] }}%; top: {{ $positions['logo']['y'] }}%;">

                    @foreach($texts as $key => $value)
                        @php $pos = $positions[$key] ?? ['x' => 50, 'y' => 50]; @endphp
                        @php $style = $styles[$key] ?? ['font_size' => 14]; @endphp
                        <div class="canvas-item text-item text-{{ $key }}" data-element="{{ $key }}" data-text-label="{{ \Illuminate\Support\Str::headline($key) }}"
                             style="left: {{ $pos['x'] }}%; top: {{ $pos['y'] }}%; font-size: {{ $style['font_size'] }}px;">
                            <span class="text-content">{!! nl2br(e($value)) !!}</span>
                            <span class="resize-handle" aria-hidden="true"></span>
                        </div>
                    @endforeach

                    <div class="canvas-item signature-item" data-element="ttd_kepsek"
                         style="left: {{ $positions['ttd_kepsek']['x'] }}%; top: {{ $positions['ttd_kepsek']['y'] }}%;">
                        <img src="" class="d-none" id="previewTtdKepsekImg" alt="TTD Kepala Sekolah">
                        <span>TTD Kepala Sekolah</span>
                    </div>

                    <div class="canvas-item signature-item" data-element="ttd_panitia"
                         style="left: {{ $positions['ttd_panitia']['x'] }}%; top: {{ $positions['ttd_panitia']['y'] }}%;">
                        <img src="" class="d-none" id="previewTtdPanitiaImg" alt="TTD Ketua Panitia">
                        <span>TTD Ketua Panitia</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($positions as $key => $position)
    <input type="hidden" name="element_positions[{{ $key }}][x]" value="{{ $position['x'] }}" data-position-x="{{ $key }}">
    <input type="hidden" name="element_positions[{{ $key }}][y]" value="{{ $position['y'] }}" data-position-y="{{ $key }}">
@endforeach

@foreach($styles as $key => $style)
    <input type="hidden" name="element_styles[{{ $key }}][font_size]" value="{{ $style['font_size'] }}" data-style-font-size="{{ $key }}">
@endforeach

</form>

<style>
    .template-editor-wrap {
        min-height: 720px;
        position: relative;
        background: #f4f6f8;
    }

    .editor-drawer {
        position: absolute;
        top: 14px;
        left: 14px;
        width: min(430px, 100%);
        height: min(690px, calc(100% - 28px));
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 18px 42px rgba(15, 23, 42, .18);
        transform: translateX(-104%);
        transition: transform .22s ease;
        z-index: 10;
    }

    .editor-drawer.show {
        transform: translateX(0);
    }

    .editor-drawer-header {
        min-height: 70px;
        padding: 14px 18px;
        border-bottom: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        cursor: move;
        user-select: none;
    }

    .editor-drawer-body {
        height: calc(100% - 70px);
        overflow-y: auto;
        padding: 18px;
    }

    .preview-scroll {
        overflow: auto;
        padding: 30px;
    }

    .certificate-canvas {
        width: min(1123px, 100%);
        min-width: 760px;
        aspect-ratio: 1123 / 794;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid #c9cdd3;
        box-shadow: 0 18px 40px rgba(15, 23, 42, .12);
        font-family: Georgia, 'Times New Roman', serif;
    }

    .certificate-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    .canvas-item {
        position: absolute;
        z-index: 2;
        transform: translate(-50%, -50%);
        cursor: move;
        user-select: none;
        touch-action: none;
        text-align: center;
        border: 1px solid transparent;
        border-radius: 4px;
        padding: 2px 8px;
    }

    .canvas-item:hover,
    .canvas-item.is-dragging,
    .canvas-item.is-selected {
        border-color: #0d6efd;
        background: rgba(13, 110, 253, .08);
    }

    .certificate-canvas.has-selection .canvas-item:not(.is-selected):hover {
        border-color: transparent;
        background: transparent;
    }

    .resize-handle {
        position: absolute;
        right: -7px;
        bottom: -7px;
        width: 13px;
        height: 13px;
        border: 2px solid #0d6efd;
        border-radius: 50%;
        background: #fff;
        cursor: nwse-resize;
        display: none;
    }

    .text-item.is-selected .resize-handle {
        display: block;
    }

    .logo-item {
        width: 58px;
        height: 58px;
        object-fit: contain;
    }

    .text-item {
        max-width: 660px;
        color: #12325d;
        line-height: 1.12;
        white-space: pre-line;
    }

    .text-eyebrow {
        font-size: 14px;
        letter-spacing: 10px;
        color: #2f2a22;
    }

    .text-title {
        font-size: 48px;
        letter-spacing: 16px;
        color: #8b6914;
        font-weight: 700;
    }

    .text-given_to {
        font-size: 17px;
        font-style: italic;
        color: #4b3c2f;
    }

    .text-participant_name {
        font-size: {{ (int) old('font_size_nama', 28) * 1.45 }}px;
        font-weight: 700;
    }

    .text-participant_info,
    .text-participation_text,
    .text-activity_detail,
    .text-certificate_number,
    .text-principal_nip,
    .text-committee_nip {
        font-size: {{ (int) old('font_size_detail', 14) * 1.05 }}px;
        color: #334155;
    }

    .text-activity_name {
        font-size: {{ (int) old('font_size_detail', 14) * 1.75 }}px;
        font-weight: 700;
    }

    .text-principal_title,
    .text-committee_title {
        width: 170px;
        min-width: 160px;
        border-top: 1px solid #222;
        padding-top: 4px;
        color: #111827;
        font-size: 13px;
        font-weight: 700;
        font-family: Arial, sans-serif;
    }

    .text-principal_name,
    .text-committee_name {
        width: 170px;
        color: #111827;
        font-size: 12px;
        font-weight: 600;
        text-decoration: underline;
        font-family: Arial, sans-serif;
    }

    .signature-item {
        width: 170px;
        min-width: 150px;
        min-height: 42px;
        display: grid;
        place-items: center;
        color: #1f2937;
        font-family: Arial, sans-serif;
        font-size: 13px;
    }

    .signature-item img {
        max-width: 125px;
        max-height: 48px;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .preview-scroll {
            padding: 16px;
        }

        .certificate-canvas {
            min-width: 720px;
        }
    }
</style>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const drawer = document.getElementById('editorDrawer');
        const drawerHeader = drawer?.querySelector('.editor-drawer-header');
        const canvas = document.getElementById('certificateCanvas');
        const defaultPositions = @json($positionsDefault);

        document.getElementById('openEditor')?.addEventListener('click', () => drawer.classList.add('show'));
        document.getElementById('closeEditor')?.addEventListener('click', () => drawer.classList.remove('show'));

        if (drawer && drawerHeader) {
            let movingDrawer = false;
            let drawerShiftX = 0;
            let drawerShiftY = 0;

            drawerHeader.addEventListener('pointerdown', event => {
                if (event.target.closest('button')) return;

                movingDrawer = true;
                drawerHeader.setPointerCapture(event.pointerId);

                const drawerRect = drawer.getBoundingClientRect();
                drawerShiftX = event.clientX - drawerRect.left;
                drawerShiftY = event.clientY - drawerRect.top;
            });

            drawerHeader.addEventListener('pointermove', event => {
                if (!movingDrawer) return;

                const wrapperRect = drawer.closest('.template-editor-wrap').getBoundingClientRect();
                const drawerRect = drawer.getBoundingClientRect();
                const maxLeft = wrapperRect.width - drawerRect.width - 12;
                const maxTop = wrapperRect.height - drawerRect.height - 12;
                let nextLeft = event.clientX - wrapperRect.left - drawerShiftX;
                let nextTop = event.clientY - wrapperRect.top - drawerShiftY;

                nextLeft = Math.max(12, Math.min(maxLeft, nextLeft));
                nextTop = Math.max(12, Math.min(maxTop, nextTop));

                drawer.style.left = `${nextLeft}px`;
                drawer.style.top = `${nextTop}px`;
            });

            const stopMovingDrawer = () => movingDrawer = false;
            drawerHeader.addEventListener('pointerup', stopMovingDrawer);
            drawerHeader.addEventListener('pointercancel', stopMovingDrawer);
        }

        const escapeHtml = value => value
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('\n', '<br>');

        document.querySelectorAll('.js-text-field').forEach(input => {
            input.addEventListener('input', () => {
                const target = document.querySelector(`[data-element="${input.dataset.target}"]`);
                const content = target?.querySelector('.text-content');
                if (content) content.innerHTML = escapeHtml(input.value);
            });
        });

        const applyAlignment = value => {
            const textAlign = { kiri: 'left', tengah: 'center', kanan: 'right' }[value] || 'center';
            document.querySelectorAll('.text-item').forEach(item => item.style.textAlign = textAlign);
        };

        document.querySelectorAll('[name="perataan_teks"]').forEach(input => {
            input.addEventListener('change', () => applyAlignment(input.value));
            if (input.checked) applyAlignment(input.value);
        });

        const selectedFontSize = document.getElementById('selectedFontSize');
        const selectedElementLabel = document.getElementById('selectedElementLabel');
        let selectedTextItem = null;

        const setStyleInput = (key, value) => {
            const input = document.querySelector(`[data-style-font-size="${key}"]`);
            if (input) input.value = Number(value).toFixed(2);
        };

        const selectTextItem = item => {
            if (!item?.classList.contains('text-item')) return;

            document.querySelectorAll('.text-item.is-selected').forEach(text => text.classList.remove('is-selected'));
            selectedTextItem = item;
            selectedTextItem.classList.add('is-selected');
            canvas.classList.add('has-selection');

            if (selectedFontSize) selectedFontSize.value = Math.round(Number.parseFloat(selectedTextItem.style.fontSize) || 14);
            if (selectedElementLabel) selectedElementLabel.value = selectedTextItem.dataset.textLabel || selectedTextItem.dataset.element;
        };

        selectedFontSize?.addEventListener('input', event => {
            if (!selectedTextItem) return;

            const fontSize = Math.max(6, Math.min(120, Number(event.target.value || 14)));
            selectedTextItem.style.fontSize = `${fontSize}px`;
            setStyleInput(selectedTextItem.dataset.element, fontSize);
        });

        const bindImagePreview = (inputId, imageId, fallbackSelector = null) => {
            const input = document.getElementById(inputId);
            const image = document.getElementById(imageId);
            if (!input || !image) return;

            input.addEventListener('change', event => {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = readerEvent => {
                    image.src = readerEvent.target.result;
                    image.classList.remove('d-none');
                    if (fallbackSelector) document.querySelector(fallbackSelector)?.remove();
                };
                reader.readAsDataURL(file);
            });
        };

        bindImagePreview('inputBg', 'previewBgImg');
        bindImagePreview('inputLogoSekolah', 'previewLogoSekolahImg');
        bindImagePreview('inputTtdKepsek', 'previewTtdKepsekImg', '[data-element="ttd_kepsek"] span');
        bindImagePreview('inputTtdPanitia', 'previewTtdPanitiaImg', '[data-element="ttd_panitia"] span');

        document.querySelectorAll('.js-remove-image').forEach(button => {
            button.addEventListener('click', () => {
                const fileInput = document.getElementById(button.dataset.input);
                const image = document.getElementById(button.dataset.image);
                const wrapper = image?.closest('.canvas-item');

                if (fileInput) fileInput.value = '';
                if (image) {
                    image.removeAttribute('src');
                    image.classList.add('d-none');
                }

                if (button.dataset.fallback && wrapper && !wrapper.querySelector('span')) {
                    const fallback = document.createElement('span');
                    fallback.textContent = button.dataset.fallback;
                    wrapper.appendChild(fallback);
                }
            });
        });

        const setPositionInput = (key, axis, value) => {
            const input = document.querySelector(`[data-position-${axis}="${key}"]`);
            if (input) input.value = value.toFixed(2);
        };

        document.getElementById('resetPositions')?.addEventListener('click', () => {
            Object.entries(defaultPositions).forEach(([key, position]) => {
                const item = document.querySelector(`[data-element="${key}"]`);
                if (!item) return;

                item.style.left = `${position.x}%`;
                item.style.top = `${position.y}%`;
                setPositionInput(key, 'x', Number(position.x));
                setPositionInput(key, 'y', Number(position.y));
            });
        });

        const moveAll = yChange => {
            document.querySelectorAll('.canvas-item').forEach(item => {
                const x = Number.parseFloat(item.style.left) || 50;
                const y = Number.parseFloat(item.style.top) || 50;
                const nextY = Math.max(0, Math.min(100, y + yChange));

                item.style.top = `${nextY}%`;
                setPositionInput(item.dataset.element, 'x', x);
                setPositionInput(item.dataset.element, 'y', nextY);
            });
        };

        document.getElementById('moveAllUp')?.addEventListener('click', () => moveAll(-3));
        document.getElementById('moveAllDown')?.addEventListener('click', () => moveAll(3));

        document.querySelectorAll('.text-item').forEach(item => {
            const handle = item.querySelector('.resize-handle');

            item.addEventListener('click', () => selectTextItem(item));

            handle?.addEventListener('pointerdown', event => {
                event.preventDefault();
                event.stopPropagation();
                selectTextItem(item);

                let resizing = true;
                const startX = event.clientX;
                const startY = event.clientY;
                const startSize = Number.parseFloat(item.style.fontSize) || 14;
                handle.setPointerCapture(event.pointerId);

                const resizeMove = moveEvent => {
                    if (!resizing) return;

                    const delta = ((moveEvent.clientX - startX) + (moveEvent.clientY - startY)) / 2;
                    const fontSize = Math.max(6, Math.min(120, startSize + (delta * 0.16)));
                    item.style.fontSize = `${fontSize}px`;
                    if (selectedFontSize) selectedFontSize.value = Math.round(fontSize);
                    setStyleInput(item.dataset.element, fontSize);
                };

                const resizeEnd = () => {
                    resizing = false;
                    handle.removeEventListener('pointermove', resizeMove);
                    handle.removeEventListener('pointerup', resizeEnd);
                    handle.removeEventListener('pointercancel', resizeEnd);
                };

                handle.addEventListener('pointermove', resizeMove);
                handle.addEventListener('pointerup', resizeEnd);
                handle.addEventListener('pointercancel', resizeEnd);
            });
        });

        selectTextItem(document.querySelector('.text-title'));

        document.querySelectorAll('.canvas-item').forEach(item => {
            let dragging = false;
            let shiftX = 0;
            let shiftY = 0;

            item.addEventListener('pointerdown', event => {
                selectTextItem(item);
                dragging = true;
                item.classList.add('is-dragging');
                item.setPointerCapture(event.pointerId);

                const rect = item.getBoundingClientRect();
                shiftX = event.clientX - rect.left - (rect.width / 2);
                shiftY = event.clientY - rect.top - (rect.height / 2);
            });

            item.addEventListener('pointermove', event => {
                if (!dragging) return;

                const canvasRect = canvas.getBoundingClientRect();
                let x = ((event.clientX - shiftX - canvasRect.left) / canvasRect.width) * 100;
                let y = ((event.clientY - shiftY - canvasRect.top) / canvasRect.height) * 100;
                x = Math.max(0, Math.min(100, x));
                y = Math.max(0, Math.min(100, y));

                item.style.left = `${x}%`;
                item.style.top = `${y}%`;
                setPositionInput(item.dataset.element, 'x', x);
                setPositionInput(item.dataset.element, 'y', y);
            });

            const stopDrag = () => {
                dragging = false;
                item.classList.remove('is-dragging');
            };

            item.addEventListener('pointerup', stopDrag);
            item.addEventListener('pointercancel', stopDrag);
        });
    });
</script>
@endpush
