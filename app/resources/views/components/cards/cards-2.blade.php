<div class="" id="container-card-2">
    <div
        class="p-[1.1vh] mt-7 w-min-[16rem] h-min-[19rem] bg-white rounded-lg shadow-lg hover:drop-shadow-xl duration-300 ease-in-out cursor-pointer flex-col inline-flex border justify-center">

        <div class="flex items-center justify-between">
            <div
                class="min-w-[300px] min-h-[250px] mb-5 border rounded shadow-md md:w-auto justify-center items-center inline-flex">
                @if (isset($image))
                    <img class="object-cover w-full h-full" src="{{ $image }}" alt="random user">
                @else
                    <div
                        class="inline-flex items-center justify-center object-cover h-full text-4xl rounded-lg text-slate-400">
                        Image
                    </div>
                @endif
            </div>
        </div>

        <div class="px-12">
            <div class="text-lg font-bold text-gray-700 ">
                {{ $name ?? 'No Name' }}
            </div>

            <div class="text-sm font-semibold text-gray-400">
                {{ $content ?? 'No Content' }}
            </div>
        </div>
        {{-- button --}}
        <div class="flex items-center justify-center mt-5">
            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 text-sm font-semibold text-white rounded-lg bg-amber-500 hover:bg-amber-600">
                {{ $content ?? 'Kunjungi' }}
            </a>
        </div>
    </div>
</div>
