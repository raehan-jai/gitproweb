<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Sekolah — Sistem Pengelolaan Sertifikat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1e3a5f;
            --secondary: #2d6a9f;
            --accent: #c8a000;
            --light-bg: #f8faff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--light-bg);
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar-custom {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            padding: 14px 0;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
        }

        .navbar-brand-text {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .navbar-brand-text span {
            color: var(--accent);
        }

        .btn-nav-login {
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 50px;
            padding: 7px 22px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .btn-nav-login:hover {
            background: var(--primary);
            color: #fff;
        }

        .btn-nav-register {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border-radius: 50px;
            padding: 7px 22px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            transition: all 0.3s;
        }

        .btn-nav-register:hover {
            opacity: 0.9;
            color: #fff;
            transform: translateY(-1px);
        }

        /* HERO */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2444 0%, #1e3a5f 40%, #2d6a9f 70%, #1a9e72 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 80px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 700px;
            height: 700px;
            background: rgba(255,255,255,0.03);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: rgba(200,160,0,0.05);
            border-radius: 50%;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(200,160,0,0.15);
            border: 1px solid rgba(200,160,0,0.4);
            color: #f0c040;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 3.2rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-title span {
            background: linear-gradient(135deg, #f0c040, #c8a000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.7;
            margin-bottom: 35px;
            max-width: 480px;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, #c8a000, #f0c040);
            color: #1a1a1a;
            border: none;
            border-radius: 50px;
            padding: 14px 32px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(200,160,0,0.4);
            color: #1a1a1a;
        }

        .btn-hero-secondary {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-hero-secondary:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
            transform: translateY(-3px);
        }

        /* Hero Card Float */
        .hero-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 30px;
            color: #fff;
        }

        .hero-cert-preview {
            background: linear-gradient(135deg, #fffdf0, #fff);
            border-radius: 14px;
            padding: 25px;
            border: 2px solid rgba(200,160,0,0.3);
            text-align: center;
            margin-bottom: 20px;
        }

        .cert-title-preview {
            font-size: 0.6rem;
            letter-spacing: 3px;
            color: #999;
            text-transform: uppercase;
        }

        .cert-main-preview {
            font-size: 1.5rem;
            font-weight: 800;
            color: #8b6914;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin: 4px 0;
        }

        .cert-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, #c8a000, transparent);
            margin: 8px auto;
            width: 80px;
        }

        .cert-name-preview {
            font-size: 1rem;
            font-weight: 700;
            color: #1a3a6e;
            margin: 6px 0 2px;
        }

        .cert-sub-preview {
            font-size: 0.65rem;
            color: #888;
        }

        .hero-stat {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .hero-stat:last-child { border-bottom: none; }

        .hero-stat-icon {
            width: 38px;
            height: 38px;
            background: rgba(200,160,0,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #f0c040;
            flex-shrink: 0;
        }

        .hero-stat-text { font-size: 0.85rem; color: rgba(255,255,255,0.8); }
        .hero-stat-num  { font-weight: 700; color: #fff; }

        /* FITUR */
        .section-features {
            padding: 100px 0;
            background: #fff;
        }

        .section-badge {
            display: inline-block;
            background: rgba(30,58,95,0.08);
            color: var(--primary);
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .section-desc {
            color: #666;
            font-size: 1rem;
            line-height: 1.7;
        }

        .feature-card {
            background: #fff;
            border: 1px solid #eef0f5;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(30,58,95,0.1);
            border-color: transparent;
        }

        .feature-card:hover::before { transform: scaleX(1); }

        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 18px;
        }

        .feature-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .feature-desc {
            font-size: 0.88rem;
            color: #777;
            line-height: 1.6;
        }

        /* CARA KERJA */
        .section-howto {
            padding: 100px 0;
            background: var(--light-bg);
        }

        .step-card {
            text-align: center;
            padding: 20px;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0 auto 16px auto;
        }

        .step-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .step-desc {
            font-size: 0.85rem;
            color: #777;
            line-height: 1.6;
        }

        .step-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: 1.5rem;
            padding-top: 20px;
        }

        /* ROLE */
        .section-role {
            padding: 100px 0;
            background: #fff;
        }

        .role-card {
            border-radius: 20px;
            padding: 35px 30px;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .role-card-admin {
            background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
            color: #fff;
        }

        .role-card-guru {
            background: linear-gradient(135deg, #1a6e4a, #27ae60);
            color: #fff;
        }

        .role-card-siswa {
            background: linear-gradient(135deg, #7b2d8b, #9b59b6);
            color: #fff;
        }

        .role-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .role-title {
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .role-sub {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-bottom: 20px;
        }

        .role-list {
            list-style: none;
            padding: 0;
        }

        .role-list li {
            font-size: 0.88rem;
            opacity: 0.9;
            padding: 5px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .role-list li::before {
            content: '✓';
            background: rgba(255,255,255,0.2);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            flex-shrink: 0;
        }

        /* CTA */
        .section-cta {
            padding: 100px 0;
            background: linear-gradient(135deg, #0f2444, #1e3a5f, #2d6a9f);
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
        }

        .cta-desc {
            color: rgba(255,255,255,0.7);
            font-size: 1rem;
            margin-bottom: 35px;
        }

        /* FOOTER */
        .footer {
            background: #0a1628;
            color: rgba(255,255,255,0.6);
            text-align: center;
            padding: 24px 0;
            font-size: 0.85rem;
        }

        .footer span { color: #f0c040; }

        /* SCROLL ANIMATION */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar-custom">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#1e3a5f,#2d6a9f);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-award-fill text-white" style="font-size:1.1rem;"></i>
            </div>
            <span class="navbar-brand-text">Sertifikat<span>Sekolah</span></span>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('login') }}" class="btn btn-nav-login">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-nav-register">Daftar Sekarang</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 fade-up">
                <div class="hero-badge">
                    <i class="bi bi-stars me-1"></i> SISTEM SERTIFIKAT DIGITAL
                </div>
                <h1 class="hero-title">
                    Kelola Sertifikat Kegiatan Sekolah
                    <span>Lebih Mudah & Cepat</span>
                </h1>
                <p class="hero-desc">
                    Generate sertifikat otomatis untuk semua peserta kegiatan sekolah.
                    Upload template, tambah peserta, dan sertifikat siap download dalam hitungan detik.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn-hero-primary">
                        <i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero-secondary">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sudah Punya Akun
                    </a>
                </div>
            </div>

          <div class="col-lg-6 fade-up">
    <div class="hero-card">

        <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
            <div style="width:10px;height:10px;border-radius:50%;background:#ff5f57;"></div>
            <div style="width:10px;height:10px;border-radius:50%;background:#febc2e;"></div>
            <div style="width:10px;height:10px;border-radius:50%;background:#28c840;"></div>
            <span style="font-size:0.75rem;color:rgba(255,255,255,0.4);margin-left:6px;">Dashboard Sertifikat Sekolah</span>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
            <div style="background:rgba(255,255,255,0.05);border-radius:12px;padding:14px;">
                <div style="font-size:0.7rem;color:rgba(255,255,255,0.4);margin-bottom:6px;">Generate Cepat</div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:32px;height:32px;background:rgba(240,192,64,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#f0c040;font-size:1rem;">⚡</div>
                    <div style="font-size:0.8rem;font-weight:600;color:#fff;">1 Klik Selesai</div>
                </div>
            </div>
            <div style="background:rgba(255,255,255,0.05);border-radius:12px;padding:14px;">
                <div style="font-size:0.7rem;color:rgba(255,255,255,0.4);margin-bottom:6px;">Export Format</div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:32px;height:32px;background:rgba(220,53,69,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#ff6b6b;font-size:1rem;">📄</div>
                    <div style="font-size:0.8rem;font-weight:600;color:#fff;">PDF A4 HD</div>
                </div>
            </div>
        </div>

    </div>
</div>

                    <div class="hero-stat">
                        <div class="hero-stat-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                        <div class="hero-stat-text">
                            <div class="hero-stat-num">Generate Otomatis</div>
                            Sertifikat untuk semua peserta dalam 1 klik
                        </div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-icon"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                        <div class="hero-stat-text">
                            <div class="hero-stat-num">Export PDF</div>
                            Kualitas tinggi siap cetak & download
                        </div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-icon"><i class="bi bi-shield-check"></i></div>
                        <div class="hero-stat-text">
                            <div class="hero-stat-num">Nomor Unik Otomatis</div>
                            Setiap sertifikat memiliki kode unik
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FITUR -->
<section class="section-features">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-badge">FITUR UNGGULAN</div>
            <h2 class="section-title">Semua yang Kamu Butuhkan</h2>
            <p class="section-desc">Dirancang khusus untuk kebutuhan pengelolaan sertifikat kegiatan sekolah</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:rgba(30,58,95,0.1);color:#1e3a5f;">
                        <i class="bi bi-layout-text-window"></i>
                    </div>
                    <div class="feature-title">Template Kustom</div>
                    <div class="feature-desc">Upload background sertifikat sendiri dan atur tanda tangan kepala sekolah beserta panitia.</div>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:rgba(26,110,74,0.1);color:#1a6e4a;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="feature-title">Import Peserta Massal</div>
                    <div class="feature-desc">Import ratusan peserta sekaligus dari file Excel atau CSV. Hemat waktu tanpa input manual.</div>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:rgba(200,160,0,0.1);color:#c8a000;">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <div class="feature-title">Generate 1 Klik</div>
                    <div class="feature-desc">Generate sertifikat untuk semua peserta dalam satu kegiatan hanya dengan satu klik tombol.</div>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:rgba(220,53,69,0.1);color:#dc3545;">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                    </div>
                    <div class="feature-title">Export PDF Berkualitas</div>
                    <div class="feature-desc">Sertifikat diexport dalam format PDF A4 landscape dengan kualitas cetak tinggi.</div>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:rgba(13,110,253,0.1);color:#0d6efd;">
                        <i class="bi bi-qr-code"></i>
                    </div>
                    <div class="feature-title">Nomor Unik Otomatis</div>
                    <div class="feature-desc">Setiap sertifikat mendapat nomor unik otomatis yang bisa digunakan untuk verifikasi keaslian.</div>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:rgba(111,66,193,0.1);color:#6f42c1;">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div class="feature-title">Akses Multi Role</div>
                    <div class="feature-desc">Admin, Guru/Panitia, dan Siswa memiliki hak akses berbeda sesuai kebutuhan masing-masing.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CARA KERJA -->
<section class="section-howto">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-badge">CARA KERJA</div>
            <h2 class="section-title">Mudah dalam 4 Langkah</h2>
            <p class="section-desc">Dari setup hingga sertifikat siap download, hanya butuh beberapa menit</p>
        </div>

        <div class="row align-items-center justify-content-center g-0">
            <div class="col-md-2 fade-up">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-title">Buat Kegiatan</div>
                    <div class="step-desc">Tambahkan data kegiatan seperti nama, tanggal, dan penyelenggara</div>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-flex fade-up">
                <div class="step-arrow"><i class="bi bi-arrow-right"></i></div>
            </div>
            <div class="col-md-2 fade-up">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-title">Tambah Peserta</div>
                    <div class="step-desc">Import dari Excel atau tambah manual satu per satu</div>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-flex fade-up">
                <div class="step-arrow"><i class="bi bi-arrow-right"></i></div>
            </div>
            <div class="col-md-2 fade-up">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-title">Pilih Template</div>
                    <div class="step-desc">Pilih template sertifikat dengan background dan tanda tangan</div>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-flex fade-up">
                <div class="step-arrow"><i class="bi bi-arrow-right"></i></div>
            </div>
            <div class="col-md-2 fade-up">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-title">Generate & Download</div>
                    <div class="step-desc">Klik generate dan sertifikat PDF siap download untuk semua peserta</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ROLE -->
<section class="section-role">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-badge">HAK AKSES</div>
            <h2 class="section-title">Untuk Siapa Sistem Ini?</h2>
            <p class="section-desc">Tiga jenis pengguna dengan hak akses yang disesuaikan</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4 fade-up">
                <div class="role-card role-card-admin">
                    <div class="role-icon"><i class="bi bi-shield-lock-fill"></i></div>
                    <div class="role-title">Administrator</div>
                    <div class="role-sub">Akses penuh ke semua fitur</div>
                    <ul class="role-list">
                        <li>Kelola semua kegiatan</li>
                        <li>Kelola semua peserta</li>
                        <li>Buat & edit template sertifikat</li>
                        <li>Upload tanda tangan</li>
                        <li>Generate & hapus sertifikat</li>
                        <li>Lihat statistik dashboard</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="role-card role-card-guru">
                    <div class="role-icon"><i class="bi bi-person-workspace"></i></div>
                    <div class="role-title">Guru / Panitia</div>
                    <div class="role-sub">Kelola kegiatan dan sertifikat</div>
                    <ul class="role-list">
                        <li>Buat & kelola kegiatan</li>
                        <li>Tambah & import peserta</li>
                        <li>Generate sertifikat otomatis</li>
                        <li>Download sertifikat peserta</li>
                        <li>Lihat statistik dashboard</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="role-card role-card-siswa">
                    <div class="role-icon"><i class="bi bi-mortarboard-fill"></i></div>
                    <div class="role-title">Siswa</div>
                    <div class="role-sub">Akses sertifikat pribadi</div>
                    <ul class="role-list">
                        <li>Register & login mandiri</li>
                        <li>Lihat sertifikat yang dimiliki</li>
                        <li>Download sertifikat PDF</li>
                        <li>Riwayat kegiatan yang diikuti</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-cta">
    <div class="container fade-up">
        <h2 class="cta-title">Siap Memulai?</h2>
        <p class="cta-desc">Daftarkan diri sekarang dan kelola sertifikat kegiatan sekolahmu dengan lebih mudah</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('register') }}" class="btn-hero-primary">
                <i class="bi bi-person-plus me-2"></i>Daftar Gratis Sekarang
            </a>
            <a href="{{ route('login') }}" class="btn-hero-secondary">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login ke Akun
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <i class="bi bi-award-fill" style="color:#c8a000;"></i>
        <span> SertifikatSekolah</span> &mdash; Sistem Pengelolaan Sertifikat Digital &copy; 2026
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, i * 100);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
</body>
</html>