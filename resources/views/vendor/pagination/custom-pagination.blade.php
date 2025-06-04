@php
// Calculate the range for visible pagination links
$start = max(1, $paginator->currentPage() - 2); // Start 2 pages before the current page
$end = min($paginator->lastPage(), $paginator->currentPage() + 2); // End 2 pages after the current page
@endphp

@if ($paginator->hasPages() && $paginator->lastPage() > 1)
<nav aria-label="Page navigation">
    <ul class="pagination pagination-secondary">
        {{-- First Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link"><span>«</span></span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="First">
                <span>«</span>
            </a>
        </li>
        @endif

        {{-- Previous Page Link --}}
        {{-- @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link"><i class="tf-icon bx bx-chevron-left"></i></span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                <i class="tf-icon bx bx-chevron-left"></i>
            </a>
        </li>
        @endif --}}

        {{-- Handle Ellipses and First Page --}}
        @if ($start > 1)
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
        </li>
        {{-- Render ellipses only if there's a gap --}}
        @if ($start > 2)
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        @endif
        @endif

        {{-- Render Visible Range --}}
        @foreach (range($start, $end) as $page)
        @if ($page == $paginator->currentPage())
        <li class="page-item active" aria-current="page">
            <span class="page-link">{{ $page }}</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach

        {{-- Handle Ellipses and Last Page --}}
        @if ($end < $paginator->lastPage())
            {{-- Render ellipses only if there's a gap --}}
            @if ($end < $paginator->lastPage() - 1)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                        {{ $paginator->lastPage() }}
                    </a>
                </li>
                @endif

                {{-- Next Page Link --}}
                {{-- @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link"><i class="tf-icon bx bx-chevron-right"></i></span>
                </li>
                @endif --}}

                {{-- Last Page Link --}}
                @if (!$paginator->onLastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last">
                        <span>»</span>
                    </a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link"><span>»</span></span>
                </li>
                @endif
    </ul>
</nav>
@else
{{-- Display default design for single page --}}
<nav aria-label="Page navigation">
    <ul class="pagination pagination-secondary">
        <li class="page-item disabled">
            <span class="page-link">No Pages</span>
        </li>
    </ul>
</nav>
@endif