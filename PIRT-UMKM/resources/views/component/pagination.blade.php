@if ($paginator->hasPages())
<div class="pagination">

    {{-- PREVIOUS --}}
    @if ($paginator->onFirstPage())
        <button class="nav disabled">‹</button>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="nav">‹</a>
    @endif

    {{-- PAGE NUMBERS --}}
    @foreach ($elements as $element)

        {{-- DOTS --}}
        @if (is_string($element))
            <span class="dots">…</span>
        @endif

        {{-- LINKS --}}
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

    {{-- NEXT --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="nav">›</a>
    @else
        <button class="nav disabled">›</button>
    @endif

</div>
@endif
