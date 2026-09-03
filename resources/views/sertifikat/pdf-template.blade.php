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

    $styleNama     = 'font-size:' . $fontNama   . 'pt;font-weight:bold;color:#1a3a6e;margin-bottom:3px;';
    $styleKegiatan = 'font-size:' . $fontDetail . 'pt;font-weight:bold;color:#1e3a5f;margin-bottom:3px;';
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

        .konten {
            position: absolute;
            top: 0;
            left: 0;
            width: 297mm;
            height: 210mm;
            z-index: 2;
        }

        table.outer {
            width: 297mm;
            height: 210mm;
            border-collapse: collapse;
        }

        td.outer-cell {
            width: 297mm;
            height: 210mm;
            text-align: center;
            vertical-align: middle;
            padding: 0;
        }

        table.content-table {
            width: 220mm;
            margin: 0 auto;
            border-collapse: collapse;
        }

        td.content-cell {
            text-align: center;
            vertical-align: middle;
            padding: 0;
        }

        .label-atas {
            font-size: 7.5pt;
            color: #555;
            letter-spacing: 6px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .logo-sekolah {
            max-width: 58px;
            max-height: 58px;
            margin-bottom: 6px;
        }

        .judul {
            font-size: 30pt;
            color: #8b6914;
            font-weight: bold;
            letter-spacing: 10px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .garis-tengah {
            border: none;
            border-top: 1.5px solid #c8a000;
            width: 120px;
            margin: 0 auto 8px auto;
        }

        .teks-diberikan {
            font-size: 9pt;
            color: #555;
            font-style: italic;
            margin-bottom: 4px;
        }

        .info-penerima {
            font-size: 8pt;
            color: #666;
            margin-bottom: 6px;
        }

        .garis-nama {
            border: none;
            border-top: 1px solid #bbb;
            width: 300px;
            margin: 0 auto 8px auto;
        }

        .teks-partisipasi {
            font-size: 8.5pt;
            color: #444;
            margin-bottom: 3px;
        }

        .detail-kegiatan {
            font-size: 7.5pt;
            color: #666;
            margin-bottom: 12px;
        }

        table.ttd {
            width: 300px;
            margin: 0 auto;
            border-collapse: collapse;
        }

        td.ttd-cell {
            width: 150px;
            text-align: center;
            vertical-align: bottom;
            padding: 0 10px;
        }

        .ttd-img-wrap {
            height: 45px;
            text-align: center;
            margin-bottom: 2px;
        }

        .ttd-img {
            max-height: 45px;
            max-width: 110px;
        }

        .ttd-garis {
            border-top: 1px solid #333;
            margin-bottom: 3px;
        }

        .ttd-jabatan {
            font-size: 7.5pt;
            font-weight: bold;
            color: #222;
            margin-bottom: 2px;
        }

        .ttd-nama {
            font-size: 7pt;
            color: #333;
            text-decoration: underline;
            margin-bottom: 1px;
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

    <div class="konten">
        <table class="outer">
            <tr>
                <td class="outer-cell">
                    <table class="content-table">
                        <tr>
                            <td class="content-cell">

                                @if($logoSekolahSrc)
                                    <img src="{!! $logoSekolahSrc !!}" class="logo-sekolah" alt="Logo Sekolah">
                                @endif

                                <div class="label-atas">Penghargaan &nbsp; Prestasi</div>
                                <div class="judul">Sertifikat</div>
                                <hr class="garis-tengah">

                                <div class="teks-diberikan">Diberikan kepada</div>
                                <div style="{!! $styleNama !!}">{!! $namaPeserta !!}</div>

                                @if($kelasPeserta || $nisPeserta)
                                <div class="info-penerima">
                                    {!! $kelasPeserta !!}
                                    @if($kelasPeserta && $nisPeserta) &nbsp;&bull;&nbsp; @endif
                                    @if($nisPeserta) NIS: {!! $nisPeserta !!} @endif
                                </div>
                                @endif

                                <hr class="garis-nama">

                                <div class="teks-partisipasi">atas partisipasi dan dedikasi dalam kegiatan</div>
                                <div style="{!! $styleKegiatan !!}">&ldquo;{!! $namaKegiatan !!}&rdquo;</div>
                                <div class="detail-kegiatan">{!! $tgl !!} &nbsp;&bull;&nbsp; {!! $namaOrg !!}</div>

                                <table class="ttd">
                                    <tr>
                                        <td class="ttd-cell">
                                            <div class="ttd-img-wrap">
                                                @if($ttdKepsekSrc)
                                                    <img src="{!! $ttdKepsekSrc !!}" class="ttd-img" alt="TTD">
                                                @endif
                                            </div>
                                            <div class="ttd-garis"></div>
                                            <div class="ttd-jabatan">Kepala Sekolah</div>
                                            @if($namaKepsek)
                                                <div class="ttd-nama">{!! $namaKepsek !!}</div>
                                            @endif
                                            @if($nipKepsek)
                                                <div class="ttd-nip">NIP. {!! $nipKepsek !!}</div>
                                            @endif
                                        </td>
                                        <td class="ttd-cell">
                                            <div class="ttd-img-wrap">
                                                @if($ttdPanitiaSrc)
                                                    <img src="{!! $ttdPanitiaSrc !!}" class="ttd-img" alt="TTD">
                                                @endif
                                            </div>
                                            <div class="ttd-garis"></div>
                                            <div class="ttd-jabatan">Ketua Panitia</div>
                                            @if($namaPanitia)
                                                <div class="ttd-nama">{!! $namaPanitia !!}</div>
                                            @endif
                                            @if($nipPanitia)
                                                <div class="ttd-nip">NIP. {!! $nipPanitia !!}</div>
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <div class="nomor">NO. SERTIFIKAT : {!! $nomorSert !!}</div>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>
