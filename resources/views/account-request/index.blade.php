@extends('layouts.app')

@section('title', 'Request Akun Guru')
@section('page-title', 'Request Akun Guru')
@section('page-subtitle', 'Kelola pengajuan akun dari calon guru/panitia')

@section('content')

@if($pending->isEmpty())
<div class="card table-card mb-4">
    <div class="card-body text-center py-5 text-muted">
        <i class="bi bi-inbox" style="font-size:3rem;color:#ccc;"></i>
        <p class="mt-2 mb-0">Tidak ada pengajuan yang menunggu persetujuan.</p>
    </div>
</div>
@else
<div class="card table-card mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-hourglass-split text-warning me-2"></i>
            Menunggu Persetujuan
        </h6>
        <span class="badge bg-warning text-dark rounded-pill">{{ $pending->count() }} request</span>
    </div>
    <div class="card-body p-0">
        @foreach($pending as $req)
        <div class="p-4 border-bottom">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:46px;height:46px;background:linear-gradient(135deg,#1e3a5f,#2d6a9f);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-person-workspace text-white"></i>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $req->name }}</div>
                            <div class="text-muted small">{{ $req->email }}</div>
                            @if($req->jabatan)
                            <div class="small text-primary">{{ $req->jabatan }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @if($req->alasan)
                    <div class="small text-muted">
                        <i class="bi bi-chat-quote me-1"></i>
                        {{ Str::limit($req->alasan, 80) }}
                    </div>
                    @endif
                    <div class="small text-muted mt-1">
                        <i class="bi bi-clock me-1"></i>
                        {{ $req->created_at->diffForHumans() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <form action="{{ route('account-request.approve', $req->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm px-3"
                                    onclick="return confirm('Setujui akun untuk {{ $req->name }}?')">
                                <i class="bi bi-check-circle me-1"></i>Setujui
                            </button>
                        </form>
                        <button class="btn btn-danger btn-sm px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalReject{{ $req->id }}">
                            <i class="bi bi-x-circle me-1"></i>Tolak
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Reject --}}
        <div class="modal fade" id="modalReject{{ $req->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content rounded-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold text-danger">
                            <i class="bi bi-x-circle me-2"></i>Tolak Pengajuan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('account-request.reject', $req->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p class="text-muted small mb-3">
                                Kamu akan menolak pengajuan akun dari <strong>{{ $req->name }}</strong>.
                            </p>
                            <label class="form-label fw-semibold">Catatan untuk Pemohon (Opsional)</label>
                            <textarea name="catatan_admin" class="form-control rounded-3" rows="3"
                                      placeholder="Contoh: Data tidak lengkap, bukan guru aktif, dll."></textarea>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="bi bi-x-circle me-1"></i>Tolak Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endif

{{-- Riwayat --}}
@if($reviewed->isNotEmpty())
<div class="card table-card">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-clock-history text-muted me-2"></i>Riwayat (20 Terakhir)
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Diproses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviewed as $req)
                    <tr>
                        <td class="fw-semibold">{{ $req->name }}</td>
                        <td class="text-muted small">{{ $req->email }}</td>
                        <td class="small">{{ $req->jabatan ?? '-' }}</td>
                        <td>
                            @if($req->isApproved())
                                <span class="badge bg-success rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i>Disetujui
                                </span>
                            @else
                                <span class="badge bg-danger rounded-pill">
                                    <i class="bi bi-x-circle me-1"></i>Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="small text-muted">
                            {{ $req->reviewed_at ? \Carbon\Carbon::parse($req->reviewed_at)->format('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection