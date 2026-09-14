<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sertifikat Sekolah')</title>


    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        body { background-color: #f0f2f5; }


        /* Sidebar */
        #sidebar {
            width: 240px;
            height: calc(100vh - 60px);
            background: linear-gradient(180deg, #1e3a5f 0%, #2d6a9f 100%); /* Warna gradient asli */
            position: fixed;
            top: 60px;
            left: 0;
            z-index: 99;
            padding-top: 15px;
            transition: all 0.3s;
        }
        #sidebar .sidebar-brand {
            padding: 20px;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        #sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8); /* Warna teks putih semi transparan asli */
            padding: 10px 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin: 2px 12px;
            transition: all 0.2s;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.15); /* Efek hover asli */
            color: #ffffff;
        }
        #sidebar small {
            color: rgba(255, 255, 255, 0.5) !important;
        }
        #sidebar .nav-link i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }


        /* Main Content */
        #main-content {
            margin-left: 240px;
            padding: 25px;
            padding-top: 85px;
            min-height: 100vh;
        }


        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: #ffffff;
            padding: 0 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }


        .topbar .brand-logo {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e3a5f; /* Warna biru utama project */
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 230px;
        }


        /* Cards */
        .stat-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); }


        /* Table */
        .table-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }


        .app-pagination {
            gap: 6px;
        }


        .app-pagination .page-link {
            min-width: 38px;
            height: 38px;
            border: 1px solid #e6eaf0;
            border-radius: 10px;
            color: #1e3a5f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            box-shadow: none;
        }


        .app-pagination .page-link:hover {
            background: #eef6ff;
            border-color: #cfe4fb;
            color: #2d6a9f;
        }


        .app-pagination .page-item.active .page-link {
            background: #2d6a9f;
            border-color: #2d6a9f;
            color: #fff;
        }


        .app-pagination .page-item.disabled .page-link {
            background: #f8fafc;
            border-color: #edf0f4;
            color: #a6b0bd;
        }


        @media (max-width: 768px) {
            #sidebar { margin-left: -240px; }
            #sidebar.show { margin-left: 0; }
            #main-content { margin-left: 0; }
        }
    </style>


    @stack('styles')
</head>
<body>


{{-- ===== SIDEBAR ===== --}}
<div id="sidebar">
    <div class="sidebar-brand">
    @if(request()->routeIs('dashboard'))
        <i class="bi bi-speedometer2 me-2"></i>
    @elseif(request()->routeIs('sertifikat.milik-saya'))
        <i class="bi bi-file-earmark-check me-2"></i>
    @elseif(request()->routeIs('account-request.*'))
        <i class="bi bi-person-check me-2"></i>
    @else
        <i class="bi bi-award-fill me-2"></i>
    @endif


    <span>@yield('page-title', 'Dashboard')</span>
    </div>


    <nav class="mt-3">
        <ul class="nav flex-column">
            {{-- Dashboard (semua role) --}}
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>


            {{-- Menu Guru & Admin --}}
            @if(auth()->user()->role !== 'siswa')
            <li class="nav-item mt-2">
                <small class="text-white-50 px-3">MANAJEMEN</small>
            </li>
            <li class="nav-item">
                <a href="{{ route('kegiatan.index') }}"
                   class="nav-link {{ request()->routeIs('kegiatan.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i> Kegiatan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('peserta.index') }}"
                   class="nav-link {{ request()->routeIs('peserta.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Peserta
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sertifikat.index') }}"
                   class="nav-link {{ request()->routeIs('sertifikat.index') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-pdf"></i> Sertifikat
                </a>
            </li>
            @endif


            {{-- Menu Admin saja --}}
            {{-- Tambahkan di dalam @if(auth()->user()->isAdmin()) --}}
           @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a href="{{ route('template-sertifikat.index') }}"
                       class="nav-link {{ request()->routeIs('template-sertifikat.*') ? 'active' : '' }}">
                        <i class="bi bi-layout-text-window"></i> Template
                    </a>
                </li>
            @endif


            {{-- Menu Siswa --}}
            @if(auth()->user()->isSiswa())
            <li class="nav-item mt-2">
                <small class="text-white-50 px-3">SERTIFIKAT SAYA</small>
            </li>
            <li class="nav-item">
                <a href="{{ route('sertifikat.milik-saya') }}"
                   class="nav-link {{ request()->routeIs('sertifikat.milik-saya') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-check"></i> Sertifikat Saya
                </a>
            </li>
            @endif
           
            <li class="nav-item">
                <li class="nav-item mt-2">
                    <small class="text-white-50 px-3">PENGATURAN</small>
                </li>
                <a href="{{ route('account-request.index') }}"
                   class="nav-link {{ request()->routeIs('account-request.*') ? 'active' : '' }}">
                    <i class="bi bi-person-check"></i> Request Akun
                    @php $pendingCount = \App\Models\AccountRequest::where('status','pending')->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="badge bg-warning text-dark ms-auto">{{ $pendingCount }}</span>
                    @endif
                </a>
            </li>
        </ul>
    </nav>
</div>


{{-- ===== MAIN CONTENT ===== --}}
<div id="main-content">


    {{-- Topbar --}}
    <div class="topbar">
        <!-- Tambahkan baris logo ini paling atas di dalam topbar -->
    <a href="{{ route('dashboard') }}" class="brand-logo">
        <i class="bi bi-award-fill text-primary"></i>
        <span>Sertifikat Sekolah</span>
    </a>
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-primary rounded-pill">
                {{ ucfirst(auth()->user()->role) }}
            </span>
            <div class="dropdown">
                <button class="btn btn-light rounded-pill" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ auth()->user()->name }}
                    <i class="bi bi-chevron-down ms-1"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    {{-- Alert Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Konten Halaman --}}
    @yield('content')
</div>


<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
=======
<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarBackdrop = document.getElementById('sidebar-backdrop');

    function closeSidebar() {
        sidebar.classList.remove('show');
        sidebarBackdrop.classList.add('d-none');
    }

    sidebarToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        sidebarBackdrop.classList.toggle('d-none', !sidebar.classList.contains('show'));
    });

    sidebarBackdrop?.addEventListener('click', closeSidebar);
    document.querySelectorAll('#sidebar .nav-link').forEach(link => link.addEventListener('click', closeSidebar));
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alignmentInputs = document.querySelectorAll('[name="perataan_teks"]');
        if (!alignmentInputs.length) return;

        const findCertificatePreviewContent = () => document.querySelector(
            '#certificatePreviewContent, .certificate-preview-content, [data-preview-alignment-target]'
        );

        const applyCertificateAlignment = value => {
            const previewContent = findCertificatePreviewContent();
            if (!previewContent) return;

            const alignment = {
                kiri: { alignItems: 'flex-start', textAlign: 'left' },
                tengah: { alignItems: 'center', textAlign: 'center' },
                kanan: { alignItems: 'flex-end', textAlign: 'right' },
            }[value] || { alignItems: 'flex-start', textAlign: 'left' };

            previewContent.style.alignItems = alignment.alignItems;
            previewContent.style.textAlign = alignment.textAlign;
            previewContent.dataset.textAlignment = value;
        };

        alignmentInputs.forEach(input => {
            input.addEventListener('change', event => applyCertificateAlignment(event.target.value));

            if (input.checked) {
                applyCertificateAlignment(input.value);
            }
        });
    });
</script>
@stack('scripts')
</body>
</html>
