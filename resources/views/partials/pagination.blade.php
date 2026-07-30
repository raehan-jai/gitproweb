@if ($paginator->hasPages())
@php
    $elements = \Illuminate\Pagination\UrlWindow::make($paginator);
@endphp

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <div class="small text-muted">
        Menampilkan
        <span class="fw-semibold text-dark">{{ $paginator->firstItem() }}</span>
        -
        <span class="fw-semibold text-dark">{{ $paginator->lastItem() }}</span>
        dari
        <span class="fw-semibold text-dark">{{ $paginator->total() }}</span>
        data
    </div>

    <nav aria-label="Navigasi halaman">
        <ul class="pagination app-pagination mb-0 flex-wrap justify-content-md-end">
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->previousPageUrl() ?: '#' }}" aria-label="Sebelumnya">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $paginator->nextPageUrl() ?: '#' }}" aria-label="Berikutnya">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>
@else
<div class="small text-muted">
    Menampilkan <span class="fw-semibold text-dark">{{ $paginator->total() }}</span> data
</div>
@endif
