    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Akun Guru — Sertifikat Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2444, #1e3a5f, #2d6a9f);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .box {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .brand {
            text-align: center;
            margin-bottom: 28px;
        }
        .brand-icon {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px auto;
        }
        .title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e3a5f;
            margin-bottom: 4px;
        }
        .sub {
            font-size: 0.85rem;
            color: #888;
        }
        .form-label-c {
            font-size: 0.83rem;
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
            font-size: 0.9rem;
        }
        .input-icon-top {
            position: absolute;
            left: 13px;
            top: 13px;
            color: #bbb;
            font-size: 0.9rem;
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
        .fc-textarea {
            width: 100%;
            padding: 11px 13px 11px 38px;
            border: 1.5px solid #e5e5e5;
            border-radius: 11px;
            font-size: 0.88rem;
            background: #fff;
            transition: all 0.2s;
            outline: none;
            resize: vertical;
            min-height: 80px;
        }
        .fc-textarea:focus {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 3px rgba(30,58,95,0.07);
        }
        .info-box {
            background: rgba(30,58,95,0.05);
            border: 1px solid rgba(30,58,95,0.12);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 0.82rem;
            color: #555;
            margin-bottom: 18px;
            display: flex;
            gap: 10px;
        }
        .btn-submit {
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
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(30,58,95,0.3);
        }
        .err-box {
            background: #fdf2f2;
            border: 1px solid #f5c6cb;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.83rem;
            color: #721c24;
            margin-bottom: 16px;
        }
        .err-box ul { margin: 0; padding-left: 16px; }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #888;
            font-size: 0.82rem;
            text-decoration: none;
            margin-bottom: 22px;
        }
        .back-link:hover { color: #1e3a5f; }
    </style>
</head>
<body>
<div class="box">

    <a href="{{ route('register') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Register
    </a>

    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-person-workspace text-white fs-4"></i>
        </div>
        <div class="title">Request Akun Guru</div>
        <p class="sub">Isi form ini untuk mengajukan akun Guru/Pendamping</p>
    </div>

    @if($errors->any())
    <div class="err-box">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="info-box">
        <i class="bi bi-info-circle-fill text-primary mt-1"></i>
        <div>
            Pengajuan akun akan <strong>menunggu persetujuan Admin</strong> sebelum bisa digunakan.
            Proses biasanya membutuhkan waktu 1x24 jam.
        </div>
    </div>

    <form action="{{ route('account-request.store') }}" method="POST">
        @csrf

        <label class="form-label-c">Nama Lengkap <span class="text-danger">*</span></label>
        <div class="input-wrap">
            <i class="bi bi-person input-icon"></i>
            <input type="text" name="name" class="fc"
                   placeholder="Nama lengkap kamu"
                   value="{{ old('name') }}" required>
        </div>

        <label class="form-label-c">Email <span class="text-danger">*</span></label>
        <div class="input-wrap">
            <i class="bi bi-envelope input-icon"></i>
            <input type="email" name="email" class="fc"
                   placeholder="nama@email.com"
                   value="{{ old('email') }}" required>
        </div>

        <label class="form-label-c">Guru Pendamping</label>
        <div class="input-wrap">
            <i class="bi bi-briefcase input-icon"></i>
            <input type="text" name="jabatan" class="fc"
                   placeholder="Contoh: Klub Sains, Pembina Osis"
                   value="{{ old('jabatan') }}">
        </div>

        <div class="row g-2">
            <div class="col-6">
                <label class="form-label-c">Password <span class="text-danger">*</span></label>
                <div class="input-wrap">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" class="fc"
                           placeholder="Min. 6 karakter" required>
                </div>
            </div>
            <div class="col-6">
                <label class="form-label-c">Konfirmasi Password <span class="text-danger">*</span></label>
                <div class="input-wrap">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" name="password_confirmation" class="fc"
                           placeholder="Ulangi password" required>
                </div>
            </div>
        </div>

        <label class="form-label-c">Alasan Pengajuan</label>
        <div class="input-wrap">
            <i class="bi bi-chat-text input-icon-top"></i>
            <textarea name="alasan" class="fc-textarea"
                      placeholder="Jelaskan singkat mengapa kamu membutuhkan akun ini...">{{ old('alasan') }}</textarea>
        </div>

        <button type="submit" class="btn-submit">
            <i class="bi bi-send me-2"></i>Kirim Pengajuan
        </button>
    </form>

    <div style="text-align:center;margin-top:16px;font-size:0.83rem;color:#888;">
        Sudah punya akun? <a href="{{ route('login') }}" style="color:#1e3a5f;font-weight:700;text-decoration:none;">Login di sini</a>
    </div>

</div>
</body>
</html>