<a href="{{ $link ?? '#' }}" class="block p-6 mt-7 w-[20rem] h-[15rem] bg-white rounded-lg shadow-md hover:drop-shadow-xl duration-300 ease-in-out cursor-pointer">
    <div class="flex items-center justify-between h-full">
        {{-- INNER CARD/CONTENT --}}
        <div class="flex items-center w-full">
            <img class="w-[10rem] h-[10rem] rounded-full object-cover"
                src="{{ $foto ?? 'https://via.placeholder.com/150' }}"
                alt="{{ $name ?? 'No Name' }}">

            <div class="flex flex-col justify-center ml-4">
                <div class="text-sm font-semibold text-gray-700">
                    {{ $name ?? 'No Name' }}
                </div>
                <div class="text-sm font-semibold text-gray-500">
                    {{ $content ?? 'No Content' }}
                </div>
            </div>
        </div>
    </div>
</a>
