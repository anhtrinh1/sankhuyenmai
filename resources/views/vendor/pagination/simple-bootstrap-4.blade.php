@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">@lang('pagination.previous')</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li style="right: 0px;"  class="page-item active"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li style="right: 0px;" class="page-item"><a class="page-link disabled">{{ $page }}</a></li>
                    @else
                        <li style="right: 0px;" class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li style="right: 0px;" class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li style="right: 0px;"  class="page-item disabled"><span class="page-link">@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
