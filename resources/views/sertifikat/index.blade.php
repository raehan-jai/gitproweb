@extends('layouts.app')

@section('title', 'Sertifikat')
@section('page-title', 'Manajemen Sertifikat')

@section('content')

{{-- Form Generate Sertifikat --}}
<div class="card table-card mb-4">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-gear text-primary me-2"></i>Generate Sertifikat Otomatis
        </h6>
    </div>
    <div class="card-body p-4">
        <form action="" method="POST" id="formGenerate">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Pilih Kegiatan</label>
                    <select name="kegiatan_id" id="selectKegiatan" class="form-select" required>
                        <option value="">-- Pilih Kegiatan --</option>
                        @foreach($kegiatan as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kegiatan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Pilih Template</label>
                    <select name="template_id" class="form-select" required>
                        <option value="">-- Pilih Template --</option>
                        @foreach($template as $t)
                            <option value="{{ $t->id }}">{{ $t->nama_template }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-lightning-charge me-2"></i>Generate Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Tabel Sertifikat --}}
<div class="card table-card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-file-earmark-pdf text-danger me-2"></i>Daftar Sertifikat
        </h6>
        <span class="badge bg-primary rounded-pill">{{ $sertifikat->total() }} sertifikat</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nomor Sertifikat</th>
                        <th>Nama Peserta</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Generate</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sertifikat as $item)
                    <tr>
                        <td>{{ $sertifikat->firstItem() + $loop->index }}</td>
                        <td>
                            <code class="text-primary">{{ $item->nomor_sertifikat }}</code>
                        </td>
                        <td class="fw-semibold">{{ $item->peserta->nama ?? '-' }}</td>
                        <td>{{ $item->kegiatan->nama_kegiatan ?? '-' }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('sertifikat.download', $item) }}"
                                   class="btn btn-outline-success" target="_blank">
                                    <i class="bi bi-download"></i> Download
                                </a>
                                <form action="{{ route('sertifikat.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus sertifikat ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-file-earmark-x" style="font-size: 3rem;"></i>
                            <p class="mt-2">Belum ada sertifikat yang digenerate.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        @include('partials.pagination', ['paginator' => $sertifikat])
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Update action form generate berdasarkan kegiatan yang dipilih
    document.getElementById('selectKegiatan').addEventListener('change', function() {
        const kegiatanId = this.value;
        const form = document.getElementById('formGenerate');
        if (kegiatanId) {
            form.action = `/sertifikat/generate/${kegiatanId}`;
        }
    });
</script>
@endpush
