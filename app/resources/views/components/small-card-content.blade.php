<a href="{{ $link ?? '#' }}"
    class="block w-full max-w-sm mx-auto overflow-hidden transition-shadow duration-300 ease-in-out bg-white rounded-lg shadow-md hover:shadow-xl">
    {{-- Gambar nanti revisi ya, ini hanya stock --}}
    <div class="relative w-full overflow-hidden rounded-t-lg">
        <img class="object-cover w-full h-48"
            src="https://ui-avatars.com/api/?name={{ $name ?? 'Developer Mode' }}&background=C2410C&color=ffffff"
            alt="{{ $name ?? 'No Name' }}">
    </div>

    <div class="p-4 overflow-hidden">
        <div class="w-full">
            <div class="text-lg font-semibold text-gray-800 truncate">{{ $name ?? 'No Name' }}</div>
            <div class="mt-1 text-gray-600 truncate text-md">{{ $content ?? 'No Content' }}</div>
        </div>
    </div>


</a>
