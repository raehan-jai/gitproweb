<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Sertifikat Sekolah</title>
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
            width: 38%;
            background: linear-gradient(135deg, #0f2444 0%, #1e3a5f 50%, #2d6a9f 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 350px; height: 350px;
            background: rgba(255,255,255,0.03);
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
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
            text-align: center;
        }

        .brand-name span { color: #f0c040; }

        .brand-desc {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.6);
            text-align: center;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .role-preview {
            width: 100%;
        }

        .role-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .role-icon-mini {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .role-info-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: #fff;
        }

        .role-info-desc {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.55);
        }

        .right-panel {
            width: 62%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8faff;
            padding: 40px;
            overflow-y: auto;
        }

        .register-box {
            width: 100%;
            max-width: 520px;
            padding: 20px 0;
        }

        .register-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: #1e3a5f;
            margin-bottom: 4px;
        }

        .register-sub {
            color: #888;
            font-size: 0.88rem;
            margin-bottom: 24px;
        }

        .form-label-custom {
            font-size: 0.82rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 5px;
            display: block;
        }

        .input-wrap {
            position: relative;
            margin-bottom: 14px;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 0.95rem;
            z-index: 2;
        }

        .fc {
            width: 100%;
            padding: 11px 13px 11px 38px;
            border: 1.5px solid #e5e5e5;
            border-radius: 11px;
            font-size: 0.88rem;
            background: #fff;
            transition: all 0.2s;
            outline: none;
        }

        .fc:focus {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 3px rgba(30,58,95,0.07);
        }

        .fc.is-invalid { border-color: #dc3545; }

        .invalid-msg {
            font-size: 0.78rem;
            color: #dc3545;
            margin-top: 3px;
        }

        .role-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        .role-btn {
            border: 2px solid #e5e5e5;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #fff;
        }

        .role-btn:hover {
            border-color: #1e3a5f;
            background: rgba(30,58,95,0.03);
        }

        .role-btn.active {
            border-color: #1e3a5f;
            background: rgba(30,58,95,0.06);
        }

        .role-btn-icon {
            font-size: 1.5rem;
            margin-bottom: 4px;
        }

        .role-btn-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: #1e3a5f;
        }

        .role-btn-sub {
            font-size: 0.72rem;
            color: #888;
        }

        .siswa-fields {
            background: rgba(30,58,95,0.03);
            border: 1px solid rgba(30,58,95,0.1);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 14px;
        }

        .siswa-fields-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-register {
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
            margin-top: 6px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(30,58,95,0.3);
        }

        .login-link {
            text-align: center;
            font-size: 0.85rem;
            color: #666;
            margin-top: 16px;
        }

        .login-link a {
            color: #1e3a5f;
            font-weight: 700;
            text-decoration: none;
        }

        .alert-error-box {
            background: #fdf2f2;
            border: 1px solid #f5c6cb;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.83rem;
            color: #721c24;
            margin-bottom: 16px;
        }

        .alert-error-box ul { margin: 0; padding-left: 16px; }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 30px 20px; }
            .role-selector { grid-template-columns: 1fr 1fr; }
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
    <p class="brand-desc">Bergabung dan nikmati kemudahan pengelolaan sertifikat digital</p>

    <div class="role-preview">
        <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;text-align:center;">Pilihan Role</div>

        <div class="role-item">
            <div class="role-icon-mini" style="background:rgba(39,174,96,0.2);color:#27ae60;">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div>
                <div class="role-info-name">Guru / Panitia</div>
                <div class="role-info-desc">Kelola kegiatan & generate sertifikat</div>
            </div>
        </div>

        <div class="role-item">
            <div class="role-icon-mini" style="background:rgba(155,89,182,0.2);color:#9b59b6;">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div>
                <div class="role-info-name">Siswa</div>
                <div class="role-info-desc">Lihat & download sertifikat kamu</div>
            </div>
        </div>

        <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);border-radius:10px;padding:12px;margin-top:10px;">
            <div style="font-size:0.75rem;color:rgba(255,255,255,0.5);display:flex;align-items:center;gap:6px;">
                <i class="bi bi-info-circle"></i>
                Akun Admin hanya bisa dibuat oleh pengembang sistem
            </div>
        </div>
    </div>
</div>

<!-- RIGHT PANEL -->
<div class="right-panel">
    <div class="register-box">

        <a href="{{ route('welcome') }}" style="color:#888;font-size:0.82rem;text-decoration:none;display:inline-flex;align-items:center;gap:5px;margin-bottom:22px;">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>

        <div class="register-title">Buat Akun Baru</div>
        <p class="register-sub">Daftarkan diri kamu — gratis dan mudah</p>

        @if($errors->any())
        <div class="alert-error-box">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="hidden" name="role" id="hiddenRole" value="{{ old('role', '') }}">

            <label class="form-label-custom">Nama Lengkap</label>
            <div class="input-wrap">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="name" class="fc" placeholder="Nama lengkap kamu"
                       value="{{ old('name') }}" required>
            </div>

            <label class="form-label-custom">Alamat Email</label>
            <div class="input-wrap">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" name="email" class="fc" placeholder="nama@email.com"
                       value="{{ old('email') }}" required>
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <label class="form-label-custom">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" name="password" class="fc"
                               placeholder="Min. 6 karakter" required>
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label-custom">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" name="password_confirmation" class="fc"
                               placeholder="Ulangi password" required>
                    </div>
                </div>
            </div>

            <label class="form-label-custom">Daftar sebagai</label>
            <div class="role-selector" id="roleSelector">
               {{-- Ganti role-btn Guru dengan ini --}}
            <div class="role-btn" onclick="window.location='{{ route('account-request.create') }}'">
                <div class="role-btn-icon">👨‍🏫</div>
                <div class="role-btn-name">Guru / Panitia</div>
                <div class="role-btn-sub">Butuh persetujuan admin</div>
            </div>
                <div class="role-btn {{ old('role') == 'siswa' ? 'active' : '' }}"
                     onclick="selectRole('siswa', this)">
                    <div class="role-btn-icon">🎓</div>
                    <div class="role-btn-name">Siswa</div>
                    <div class="role-btn-sub">Download sertifikat</div>
                </div>
            </div>

            <div id="siswaFields" style="display: {{ old('role') == 'siswa' ? 'block' : 'none' }};">
                <div class="siswa-fields">
                    <div class="siswa-fields-title">
                        <i class="bi bi-person-vcard"></i> Data Siswa
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label-custom">NIS</label>
                            <div class="input-wrap">
                                <i class="bi bi-card-text input-icon"></i>
                                <input type="text" name="nis" class="fc"
                                       placeholder="Nomor Induk Siswa"
                                       value="{{ old('nis') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label-custom">NISN</label>
                            <div class="input-wrap">
                                <i class="bi bi-upc input-icon"></i>
                                <input type="text" name="nisn" class="fc"
                                       placeholder="NISN"
                                       value="{{ old('nisn') }}">
                            </div>
                        </div>
                    </div>

                    <label class="form-label-custom">Kelas</label>
                    <div class="input-wrap">
                        <i class="bi bi-building input-icon"></i>
                        <input type="text" name="kelas" class="fc"
                               placeholder="Contoh: XII RPL 1"
                               value="{{ old('kelas') }}">
                    </div>

                    @if(isset($kegiatan) && $kegiatan->isNotEmpty())
                    <label class="form-label-custom">Daftar ke Kegiatan</label>
                    <div class="input-wrap">
                        <i class="bi bi-calendar-event input-icon"></i>
                        <select name="kegiatan_id" class="fc" style="padding-left:38px;">
                            <option value="">-- Pilih Kegiatan (Opsional) --</option>
                            @foreach($kegiatan as $k)
                                <option value="{{ $k->id }}" {{ old('kegiatan_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kegiatan }} — {{ $k->tanggal->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-person-plus me-2"></i>Buat Akun Sekarang
            </button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>

    </div>
</div>

<script>
    function selectRole(role, el) {
        document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('hiddenRole').value = role;
        document.getElementById('siswaFields').style.display = role === 'siswa' ? 'block' : 'none';
    }

    // Set aktif saat page load jika ada old value
    const oldRole = '{{ old("role") }}';
    if (oldRole) {
        document.querySelectorAll('.role-btn').forEach(btn => {
            if (btn.querySelector('.role-btn-name').textContent.toLowerCase().includes(oldRole)) {
                btn.classList.add('active');
            }
        });
    }
</script>
</body>
</html>