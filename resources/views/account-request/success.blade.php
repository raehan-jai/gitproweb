<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Terkirim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2444, #1e3a5f, #2d6a9f);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .box {
            background: #fff;
            border-radius: 20px;
            padding: 50px 40px;
            width: 100%;
            max-width: 460px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .icon-wrap {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            font-size: 2.2rem;
            color: #fff;
        }
        .title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1e3a5f;
            margin-bottom: 10px;
        }
        .desc {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.7;
            margin-bottom: 28px;
        }
        .steps {
            background: #f8faff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
            text-align: left;
        }
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 6px 0;
        }
        .step-num {
            width: 24px; height: 24px;
            background: #1e3a5f;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .step-text {
            font-size: 0.85rem;
            color: #555;
            line-height: 1.5;
        }
        .btn-login {
            display: inline-block;
            background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
            color: #fff;
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(30,58,95,0.3);
            color: #fff;
        }
    </style>
</head>
<body>
<div class="box">
    <div class="icon-wrap">
        <i class="bi bi-check-lg"></i>
    </div>
    <div class="title">Pengajuan Terkirim!</div>
    <p class="desc">
        Pengajuan akun Guru/Panitia kamu sudah berhasil dikirim.
        Admin akan segera meninjau dan memproses permintaanmu.
    </p>

    <div class="steps">
        <div style="font-size:0.75rem;font-weight:700;color:#888;letter-spacing:1px;text-transform:uppercase;margin-bottom:10px;">Langkah Selanjutnya</div>
        <div class="step-item">
            <div class="step-num">1</div>
            <div class="step-text">Admin menerima notifikasi pengajuan akunmu</div>
        </div>
        <div class="step-item">
            <div class="step-num">2</div>
            <div class="step-text">Admin meninjau data dan memverifikasi identitasmu</div>
        </div>
        <div class="step-item">
            <div class="step-num">3</div>
            <div class="step-text">Jika disetujui, kamu bisa login menggunakan email dan password yang sudah didaftarkan</div>
        </div>
    </div>

    <a href="{{ route('login') }}" class="btn-login">
        <i class="bi bi-box-arrow-in-right me-2"></i>Ke Halaman Login
    </a>
</div>
</body>
</html>