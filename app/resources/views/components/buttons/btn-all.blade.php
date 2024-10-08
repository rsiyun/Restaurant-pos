{{-- <div
    class="
        border

        bg-blue-900

        h-[2.5rem]
        w-[10rem]

        flex
        items-center
        justify-center

        rounded
    ">
    <a href="{{ $url ?? '#' }}"
    class="
        font-semibold
        text-white
    ">
        {{ $title ? $title : 'Untitled Menu Button' }}
    </a>
</div> --}}

<a href="{{ $url ?? '#' }}"
    class="
        font-semibold
        text-white
    ">
    <div
        class="
            bg-blue-900

            flex
            items-center
            justify-center

            rounded

            hover:drop-shadow-[3px_3px_1px_grey]
            ease-in-out
            duration-300

            h-[2.5rem]
            w-[10rem]
        ">
        {{ $title ? $title : 'Untitled Menu Button' }}
    </div>
    </a>
