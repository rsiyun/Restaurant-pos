<div class="p-6 mt-4 bg-white rounded-lg shadow-md">
    <div class="flex items-center justify-between">
        <div class="flex items -center">
            <img class="w-12 h-12 rounded-full"
                src="https://randomuser
            .me/api/portraits/w
            omen/17.jpg" alt="random user">

            <div class="ml-2">
                <div class="text-sm font-semibold text-gray-700">
                    {{-- Jane Doe --}}
                    {{ $name ?? 'No Name' }}
                </div>
                <div class="text-sm font-semibold text-gray-500">
                    {{ $content ?? 'No Content' }}
                </div>
            </div>
        </div>
    </div>
</div>
