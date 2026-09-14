<!DOCTYPE html>
<html lang="id">
@php
    $fileToBase64 = static function (string $path): array {
        if (!file_exists($path)) return ['', ''];
        $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $mime = match ($ext) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png'         => 'image/png',
            'webp'        => 'image/webp',
            default       => 'image/png',
        };
        return [$mime, base64_encode(file_get_contents($path))];
    };

    $fontNama   = (int) ($template->font_size_nama   ?? 26);
    $fontDetail = (int) ($template->font_size_detail ?? 13);
    $texts = is_array($template->certificate_texts ?? null) ? $template->certificate_texts : [];
    $positions = is_array($template->element_positions ?? null) ? $template->element_positions : [];
    $styles = is_array($template->element_styles ?? null) ? $template->element_styles : [];
    $positionDefaults = [
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
    $positions = array_replace_recursive($positionDefaults, $positions);
    $styleDefaults = [
        'eyebrow' => ['font_size' => 14],
        'title' => ['font_size' => 48],
        'given_to' => ['font_size' => 17],
        'participant_name' => ['font_size' => $fontNama * 1.45],
        'participant_info' => ['font_size' => $fontDetail * 1.05],
        'participation_text' => ['font_size' => $fontDetail * 1.05],
        'activity_name' => ['font_size' => $fontDetail * 1.75],
        'activity_detail' => ['font_size' => $fontDetail * 1.05],
        'principal_title' => ['font_size' => 13],
        'principal_name' => ['font_size' => 12],
        'principal_nip' => ['font_size' => $fontDetail * 1.05],
        'committee_title' => ['font_size' => 13],
        'committee_name' => ['font_size' => 12],
        'committee_nip' => ['font_size' => $fontDetail * 1.05],
        'certificate_number' => ['font_size' => $fontDetail * 1.05],
    ];
    $styles = array_replace_recursive($styleDefaults, $styles);
    $text = static fn (string $key, string $fallback): string => (string) (($texts[$key] ?? '') !== '' ? $texts[$key] : $fallback);

    $perataan    = $template->perataan_teks ?? 'tengah';
    $textAlign   = match($perataan) {
        'kiri'  => 'left',
        'kanan' => 'right',
        default => 'center',
    };
    $posStyle = static function (string $key, int $widthMm) use ($positions, $textAlign): string {
        $position = $positions[$key] ?? ['x' => 50, 'y' => 50];
        $halfWidth = $widthMm / 2;

        return 'left:' . $position['x'] . '%;top:' . $position['y'] . '%;width:' . $widthMm . 'mm;margin-left:-' . $halfWidth . 'mm;text-align:' . $textAlign . ';';
    };
    $fontStyle = static fn (string $key): string => 'font-size:' . ($styles[$key]['font_size'] ?? 14) . 'px;';

    $bgSrc = '';
    if ($template && !empty($template->background_path)) {
        $bgPath = storage_path('app/public/' . $template->background_path);
        if (file_exists($bgPath)) {
            [$bgMime, $bgB64] = $fileToBase64($bgPath);
            if (!empty($bgB64)) {
                $bgSrc = 'data:' . $bgMime . ';base64,' . $bgB64;
            }
        }
    }

    $logoSekolahSrc = '';
    if ($template && $template->logo_sekolah_path) {
        $path = storage_path('app/public/' . $template->logo_sekolah_path);
        if (file_exists($path)) {
            [$mime, $b64] = $fileToBase64($path);
            if ($b64) $logoSekolahSrc = 'data:' . $mime . ';base64,' . $b64;
        }
    }

    $ttdKepsekSrc = '';
    if ($template && $template->ttd_kepsek_path) {
        $path = storage_path('app/public/' . $template->ttd_kepsek_path);
        if (file_exists($path)) {
            [$mime, $b64] = $fileToBase64($path);
            if ($b64) $ttdKepsekSrc = 'data:' . $mime . ';base64,' . $b64;
        }
    }

    $ttdPanitiaSrc = '';
    if ($template && $template->ttd_panitia_path) {
        $path = storage_path('app/public/' . $template->ttd_panitia_path);
        if (file_exists($path)) {
            [$mime, $b64] = $fileToBase64($path);
            if ($b64) $ttdPanitiaSrc = 'data:' . $mime . ';base64,' . $b64;
        }
    }

    $namaKepsek   = $template->nama_kepsek   ?? '';
    $nipKepsek    = $template->nip_kepsek    ?? '';
    $namaPanitia  = $template->nama_panitia  ?? '';
    $nipPanitia   = $template->nip_panitia   ?? '';
    $namaPeserta  = $peserta->nama           ?? '';
    $kelasPeserta = $peserta->kelas          ?? '';
    $nisPeserta   = $peserta->nis            ?? '';
    $namaKegiatan = $kegiatan->nama_kegiatan ?? '';
    $namaOrg      = $kegiatan->penyelenggara ?? '';
    $tgl          = $kegiatan->tanggal->format('d M Y');
    $nomorSert    = $sertifikat->nomor_sertifikat ?? '';
    $teksNomorSert = str_replace('PREVIEW', $nomorSert, $text('certificate_number', 'NO. SERTIFIKAT : ' . $nomorSert));

    $styleNama     = $fontStyle('participant_name') . 'font-weight:bold;color:#1a3a6e;';
    $styleKegiatan = $fontStyle('activity_name') . 'font-weight:bold;color:#1e3a5f;';
@endphp
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 297mm;
            height: 210mm;
            overflow: hidden;
            font-family: 'DejaVu Serif', serif;
        }

        .page {
            position: relative;
            width: 297mm;
            height: 210mm;
            overflow: hidden;
        }

        .bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 297mm;
            height: 210mm;
            z-index: 1;
        }

        .item {
            position: absolute;
            z-index: 2;
            line-height: 1.15;
        }

        .label-atas {
            font-size: 7.5pt;
            color: #555;
            letter-spacing: 6px;
            text-transform: uppercase;
        }

        .logo-sekolah {
            position: absolute;
            z-index: 2;
            max-width: 16mm;
            max-height: 16mm;
        }

        .judul {
            font-size: 30pt;
            color: #8b6914;
            font-weight: bold;
            letter-spacing: 10px;
            text-transform: uppercase;
        }

        .teks-diberikan {
            font-size: 9pt;
            color: #555;
            font-style: italic;
        }

        .info-penerima {
            font-size: 8pt;
            color: #666;
        }

        .teks-partisipasi {
            font-size: 8.5pt;
            color: #444;
        }

        .detail-kegiatan {
            font-size: 7.5pt;
            color: #666;
        }

        .ttd-img {
            max-height: 13mm;
            max-width: 32mm;
        }

        .ttd-jabatan {
            border-top: 1px solid #333;
            font-size: 7.5pt;
            font-weight: bold;
            color: #222;
            padding-top: 2mm;
        }

        .ttd-nama {
            font-size: 7pt;
            color: #333;
            text-decoration: underline;
        }

        .ttd-nip {
            font-size: 6.5pt;
            color: #555;
        }

        .nomor {
            font-size: 6.5pt;
            color: #666;
            letter-spacing: 1px;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<div class="page">

    @if($bgSrc)
    <img class="bg-img" src="{!! $bgSrc !!}" alt="">
    @endif

    @if($logoSekolahSrc)
        <img src="{!! $logoSekolahSrc !!}" class="logo-sekolah" style="{!! $posStyle('logo', 16) !!}" alt="Logo Sekolah">
    @endif

    <div class="item label-atas" style="{!! $posStyle('eyebrow', 95) !!}{!! $fontStyle('eyebrow') !!}">{!! e($text('eyebrow', 'Penghargaan Prestasi')) !!}</div>
    <div class="item judul" style="{!! $posStyle('title', 120) !!}{!! $fontStyle('title') !!}">{!! e($text('title', 'Sertifikat')) !!}</div>
    <div class="item teks-diberikan" style="{!! $posStyle('given_to', 70) !!}{!! $fontStyle('given_to') !!}">{!! e($text('given_to', 'Diberikan kepada')) !!}</div>
    <div class="item" style="{!! $posStyle('participant_name', 100) !!}{!! $styleNama !!}">{!! e($namaPeserta) !!}</div>

    @if($kelasPeserta || $nisPeserta)
        <div class="item info-penerima" style="{!! $posStyle('participant_info', 95) !!}{!! $fontStyle('participant_info') !!}">
            {!! e($kelasPeserta) !!}
            @if($kelasPeserta && $nisPeserta) &nbsp;&bull;&nbsp; @endif
            @if($nisPeserta) NIS: {!! e($nisPeserta) !!} @endif
        </div>
    @endif

    <div class="item teks-partisipasi" style="{!! $posStyle('participation_text', 100) !!}{!! $fontStyle('participation_text') !!}">{!! e($text('participation_text', 'atas partisipasi dan dedikasi dalam kegiatan')) !!}</div>
    <div class="item" style="{!! $posStyle('activity_name', 100) !!}{!! $styleKegiatan !!}">&ldquo;{!! e($namaKegiatan) !!}&rdquo;</div>
    <div class="item detail-kegiatan" style="{!! $posStyle('activity_detail', 95) !!}{!! $fontStyle('activity_detail') !!}">{!! e($tgl) !!} &nbsp;&bull;&nbsp; {!! e($namaOrg) !!}</div>

    <div class="item" style="{!! $posStyle('ttd_kepsek', 42) !!}">
        @if($ttdKepsekSrc)
            <img src="{!! $ttdKepsekSrc !!}" class="ttd-img" alt="TTD">
        @endif
    </div>
    <div class="item ttd-jabatan" style="{!! $posStyle('principal_title', 42) !!}{!! $fontStyle('principal_title') !!}">{!! e($text('principal_title', 'Kepala Sekolah')) !!}</div>
    @if($namaKepsek)
        <div class="item ttd-nama" style="{!! $posStyle('principal_name', 42) !!}{!! $fontStyle('principal_name') !!}">{!! e($text('principal_name', $namaKepsek)) !!}</div>
    @endif
    @if($nipKepsek)
        <div class="item ttd-nip" style="{!! $posStyle('principal_nip', 42) !!}{!! $fontStyle('principal_nip') !!}">{!! e($text('principal_nip', 'NIP. ' . $nipKepsek)) !!}</div>
    @endif

    <div class="item" style="{!! $posStyle('ttd_panitia', 42) !!}">
        @if($ttdPanitiaSrc)
            <img src="{!! $ttdPanitiaSrc !!}" class="ttd-img" alt="TTD">
        @endif
    </div>
    <div class="item ttd-jabatan" style="{!! $posStyle('committee_title', 42) !!}{!! $fontStyle('committee_title') !!}">{!! e($text('committee_title', 'Ketua Panitia')) !!}</div>
    @if($namaPanitia)
        <div class="item ttd-nama" style="{!! $posStyle('committee_name', 42) !!}{!! $fontStyle('committee_name') !!}">{!! e($text('committee_name', $namaPanitia)) !!}</div>
    @endif
    @if($nipPanitia)
        <div class="item ttd-nip" style="{!! $posStyle('committee_nip', 42) !!}{!! $fontStyle('committee_nip') !!}">{!! e($text('committee_nip', 'NIP. ' . $nipPanitia)) !!}</div>
    @endif

    <div class="item nomor" style="{!! $posStyle('certificate_number', 90) !!}{!! $fontStyle('certificate_number') !!}">{!! e($teksNomorSert) !!}</div>

</div>

</body>
</html>
