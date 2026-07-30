@extends('layouts.auth')

@section('title', 'Akses Ditolak')

@section('content')
<div class="text-center py-3">
    <div class="mb-4" style="font-size: 5rem;">🚫</div>
    <h4 class="fw-bold text-danger">Akses Ditolak</h4>
    <p class="text-muted mb-4">
        Anda tidak memiliki hak akses ke halaman ini.<br>
        Role Anda: <strong class="text-primary">{{ ucfirst(auth()->user()->role ?? 'tidak diketahui') }}</strong>
    </p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-3 px-4">
        <i class="bi bi-house me-2"></i> Kembali ke Dashboard
    </a>
</div>
@endsection