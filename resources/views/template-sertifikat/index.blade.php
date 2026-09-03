@extends('layouts.app')

@section('title', 'Template Sertifikat')
@section('page-title', 'Template Sertifikat')

@section('content')

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('template-sertifikat.create') }}" class="btn btn-primary rounded-3">
        <i class="bi bi-plus-circle me-2"></i> Buat Template
    </a>
</div>

@if($templates->isEmpty())
<div class="card table-card">
    <div class="card-body text-center py-5 text-muted">
        <i class="bi bi-layout-text-window" style="font-size: 4rem; color: #ccc;"></i>
        <h5 class="mt-3">Belum ada template</h5>
        <p>Buat template sertifikat terlebih dahulu sebelum generate sertifikat.</p>
        <a href="{{ route('template-sertifikat.create') }}" class="btn btn-primary mt-2">Buat Template</a>
    </div>
</div>
@else
<div class="row g-4">
    @foreach($templates as $template)
    <div class="col-md-6 col-lg-4">
        <div class="card stat-card h-100">
            {{-- Preview Background --}}
            @if($template->background_path)
            <img src="{{ Storage::url($template->background_path) }}"
                 class="card-img-top" style="height: 160px; object-fit: cover;" alt="Background">
            @else
            <div class="d-flex align-items-center justify-content-center"
                 style="height:160px; background:linear-gradient(135deg,#f0f4ff,#e8f0fe);">
                <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
            </div>
            @endif

            <div class="card-body p-3">
                <h6 class="fw-bold mb-1">{{ $template->nama_template }}</h6>
                <small class="text-muted">
                    Font nama: {{ $template->font_size_nama }}pt &nbsp;|&nbsp;
                    Font detail: {{ $template->font_size_detail }}pt
                </small>
            </div>

            <div class="card-footer bg-white border-0 pb-3 px-3">
                <div class="d-flex gap-2">
                    <a href="{{ route('template-sertifikat.edit', $template) }}"
                       class="btn btn-outline-warning btn-sm flex-fill">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <form action="{{ route('template-sertifikat.destroy', $template) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus template ini?')" class="flex-fill">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm w-100">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection