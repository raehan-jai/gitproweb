<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sertifikat Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
        }

        .left-panel {
            width: 45%;
            background: linear-gradient(135deg, #0f2444 0%, #1e3a5f 50%, #2d6a9f 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 50px;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.03);
            border-radius: 50%;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 300px; height: 300px;
            background: rgba(200,160,0,0.05);
            border-radius: 50%;
        }

        .brand-logo {
            width: 64px; height: 64px;
            background: rgba(255,255,255,0.1);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 20px;
            border: 1px solid rgba(255,255,255,0.15);
        }

        .brand-name {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }

        .brand-name span { color: #f0c040; }

        .brand-desc {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.6);
            text-align: center;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .cert-mini {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            padding: 20px;
            width: 100%;
            max-width: 300px;
        }

        .cert-mini-inner {
            background: linear-gradient(135deg, #fffdf0, #fff);
            border-radius: 10px;
            padding: 18px;
            text-align: center;
            border: 1.5px solid rgba(200,160,0,0.3);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
        }

        .info-item:last-child { border-bottom: none; }

        .info-icon {
            width: 32px; height: 32px;
            background: rgba(200,160,0,0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f0c040;
            flex-shrink: 0;
        }

        .right-panel {
            width: 55%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8faff;
            padding: 60px 40px;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e3a5f;
            margin-bottom: 6px;
        }

        .login-sub {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 32px;
        }

        .form-label-custom {
            font-size: 0.85rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 18px;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1rem;
            z-index: 2;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid #e0e0e0;
            border-radius: 12px;
            font-size: 0.9rem;
            background: #fff;
            transition: all 0.3s;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 3px rgba(30,58,95,0.08);
        }

        .form-control-custom.is-invalid {
            border-color: #dc3545;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            cursor: pointer;
            z-index: 2;
            background: none;
            border: none;
            padding: 0;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(30,58,95,0.3);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: #ccc;
            font-size: 0.8rem;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .register-link {
            text-align: center;
            font-size: 0.88rem;
            color: #666;
        }

        .register-link a {
            color: #1e3a5f;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link a:hover { text-decoration: underline; }

        .alert-custom {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.85rem;
            color: #856404;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-error {
            background: #fdf2f2;
            border-color: #f5c6cb;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 40px 24px; }
        }
    </style>
</head>
<body>

<!-- LEFT PANEL -->
<div class="left-panel">
    <div class="brand-logo">
        <i class="bi bi-award-fill text-warning"></i>
    </div>
    <div class="brand-name">Sertifikat<span>Sekolah</span></div>
    <p class="brand-desc">Sistem Pengelolaan Sertifikat Digital untuk Kegiatan Sekolah</p>

 <div style="width:100%;margin-bottom:28px;">
    <div style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:20px;">
        <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;margin-bottom:14px;">Kenapa Pakai Sistem Ini?</div>

        <div class="info-item">
            <div class="info-icon">⚡</div>
            <div>Generate sertifikat otomatis 1 klik untuk semua peserta</div>
        </div>
        <div class="info-item">
            <div class="info-icon">📄</div>
            <div>Export PDF kualitas tinggi siap cetak A4 landscape</div>
        </div>
        <div class="info-item">
            <div class="info-icon">📊</div>
            <div>Import ratusan peserta sekaligus via Excel/CSV</div>
        </div>
        <div class="info-item">
            <div class="info-icon">🔐</div>
            <div>Nomor sertifikat unik otomatis untuk verifikasi</div>
        </div>
    </div>
</div>


    </div>
</div>

<!-- RIGHT PANEL -->
<div class="right-panel">
    <div class="login-box">

        <a href="{{ route('welcome') }}" style="color:#888;font-size:0.85rem;text-decoration:none;display:inline-flex;align-items:center;gap:5px;margin-bottom:28px;">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>

        <div class="login-title">Selamat Datang!</div>
        <p class="login-sub">Masuk ke akun kamu untuk melanjutkan</p>

        @if($errors->any())
        <div class="alert-custom alert-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            {{ $errors->first() }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert-custom">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <label class="form-label-custom">Alamat Email</label>
                <div class="input-group-custom">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control-custom"
                           placeholder="nama@email.com"
                           value="{{ old('email') }}" required>
                </div>
            </div>

            <div>
                <label class="form-label-custom">Password</label>
                <div class="input-group-custom" style="position:relative;">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" id="passwordInput"
                           class="form-control-custom" placeholder="Masukkan password" required>
                    <button type="button" class="toggle-password" onclick="togglePass()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
            </button>
        </form>

        <div class="divider">atau</div>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>

    </div>
</div>

<script>
    function togglePass() {
        const input = document.getElementById('passwordInput');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }
</script>
</body>
</html>