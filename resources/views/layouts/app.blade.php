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
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1e3a5f 0%, #2d6a9f 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
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
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.2s;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        #sidebar .nav-link i { margin-right: 10px; width: 20px; }

        /* Main Content */
        #main-content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            #sidebar { margin-left: -260px; }
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
        <i class="bi bi-award-fill me-2"></i>
        Sertifikat Sekolah
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
            
            @if(auth()->user()->isAdmin())
                <li class="nav-item mt-2">
                    <small class="text-white-50 px-3">PENGATURAN</small>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account-request.index') }}"
                       class="nav-link {{ request()->routeIs('account-request.*') ? 'active' : '' }}">
                        <i class="bi bi-person-check"></i> Request Akun
                        @php $pendingCount = \App\Models\AccountRequest::where('status', 'pending')->count(); @endphp
                        @if($pendingCount > 0)
                            <span class="badge bg-warning text-dark ms-auto">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div id="main-content">

    {{-- Topbar --}}
    <div class="topbar">
        <div>
            <h5 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h5>
            <small class="text-muted">@yield('page-subtitle', '')</small>
        </div>
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


