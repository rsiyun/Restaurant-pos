{{-- Side Navbar Text --}}
@php
    $class = '';
@endphp

<a href="{{ $url ?? '#' }}"
    class="block px-4 py-2 mt-4 text-xl font-light transition hover:bg-white hover:text-black hover:duration-500 hover:ease-in-out">
    {{ $title ? $title : 'Untitled Menu Button' }}
</a>
