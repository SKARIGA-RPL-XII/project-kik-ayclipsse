<div class="search-wrapper">
    <div class="search-input">
        <img src="{{ asset('img/search.png') }}" class="search-icon">
        <input type="text"
               id="{{ $inputId }}"
               placeholder="Cari Data...">
    </div>

    <button type="button"
            class="refresh-btn"
            id="{{ $refreshId }}">
        <img src="{{ asset('img/refresh.png') }}">
    </button>
</div>
