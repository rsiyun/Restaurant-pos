<a href="{{ $url ?? '#' }}">
    <div class="dropdown">
        <button class="dropdown-button">{{ $title }}</button>
        <div class="dropdown-content">
            <a href="{{ $url }}">Link 1</a>
            <a href="{{ $url }}">Link 2</a>
            <a href="{{ $url }}">Link 3</a>
        </div>
    </div>

    {{ $title ? $title : 'Title' }}
</a>
