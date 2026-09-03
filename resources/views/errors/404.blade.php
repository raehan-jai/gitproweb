@extends('layouts.auth')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="text-center py-3">
    <div class="mb-3" style="font-size: 5rem;">🔍</div>
    <h4 class="fw-bold">404 — Tidak Ditemukan</h4>
    <p class="text-muted mb-4">Halaman yang kamu cari tidak ada atau sudah dipindahkan.</p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-3 px-4">
        <i class="bi bi-house me-2"></i> Kembali ke Dashboard
    </a>
</div>
@endsection