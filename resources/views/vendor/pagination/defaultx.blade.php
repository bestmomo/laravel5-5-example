@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="page-numbers prev inactive">@lang('pagination.previous')</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-numbers prev" rel="prev">@lang('pagination.previous')</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="page-numbers current">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-numbers current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"  class="page-numbers next" rel="next">@lang('pagination.next')</a>
        @else
            <span class="page-numbers next inactive">@lang('pagination.next')</span>
        @endif
    </nav>
@endif