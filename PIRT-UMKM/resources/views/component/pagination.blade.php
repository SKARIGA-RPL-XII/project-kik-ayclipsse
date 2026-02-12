@if ($paginator->hasPages())
<div class="pagination">

    @if ($paginator->onFirstPage())
        <button class="nav disabled">‹</button>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="nav">‹</a>
    @endif

    @foreach ($elements as $element)

        @if (is_string($element))
            <span class="dots">…</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button class="active">{{ $page }}</button>
                @else
                    <a href="{{ $url }}" class="page">{{ $page }}</a>
                @endif
            @endforeach
        @endif

    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="nav">›</a>
    @else
        <button class="nav disabled">›</button>
    @endif

</div>
@endif
