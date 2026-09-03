@extends('layouts.app')

@section('title', 'Sertifikat Saya')
@section('page-title', 'Sertifikat Saya')
@section('page-subtitle', 'Daftar sertifikat yang kamu miliki')

@section('content')

@if($sertifikat->isEmpty())
<div class="card table-card">
    <div class="card-body text-center py-5 text-muted">
        <i class="bi bi-file-earmark-x" style="font-size: 4rem; color: #ccc;"></i>
        <h5 class="mt-3">Belum ada sertifikat</h5>
        <p>Sertifikat akan muncul di sini setelah panitia menerbitkannya.</p>
    </div>
</div>
@else
<div class="row g-4">
    @foreach($sertifikat as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:50px;height:50px;background:linear-gradient(135deg,#667eea,#764ba2);">
                        <i class="bi bi-award text-white fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $item->kegiatan->nama_kegiatan ?? '-' }}</h6>
                        <small class="text-muted">{{ $item->kegiatan->tanggal->format('d M Y') ?? '' }}</small>
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">Nomor Sertifikat</small>
                    <code class="text-primary">{{ $item->nomor_sertifikat }}</code>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">Penyelenggara</small>
                    <span>{{ $item->kegiatan->penyelenggara ?? '-' }}</span>
                </div>

                <a href="{{ route('sertifikat.download', $item) }}"
                   class="btn btn-primary w-100 rounded-3 fw-semibold">
                    <i class="bi bi-download me-2"></i> Download PDF
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $sertifikat->links() }}
</div>
@endif

@endsection