<div class="p-6 mt-4 w-[20rem] h-[15rem] bg-white rounded-lg shadow-md">

    <div class="flex items-center justify-between">

        {{-- INNER CARD/ CONTENT --}}
        <div class="flex w-[20rem] items-center">

            <img class="w-[10rem] rounded-full"
                src="{{$foto ?? "link" }}"
                alt="random user">

            <div class="ml-2">
                <div class="text-sm font-semibold text-gray-700">
                    {{ $name ?? 'No Name' }}
                </div>
                <div class="text-sm font-semibold text-gray-500">
                    {{ $content ?? 'No Content' }}
                </div>
            </div>

        </div>

        {{-- https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU --}}
    </div>
</div>
