<div class="" id="container-card-2">
    <div
        {{-- class="p-[1.1vh] mt-7 w-min-[18rem] h-min-[15rem] bg-white rounded-lg shadow-lg hover:drop-shadow-xl duration-300 ease-in-out cursor-pointer flex-col inline-flex border justify-center"> --}}
        class="p-[1.1vh] mt-7 h-[18rem] rounded-sm shadow-[3px_3px_3px_gainsboro] duration-300 ease-in-out flex-col inline-flex border justify-center">
        <div class="flex items-center justify-between">
            <div
                {{-- class="min-w-[300px] min-h-[160px] mb-4.5 border bg-slate-300 rounded shadow-md md:w-auto justify-center items-center inline-flex"> --}}
                class="min-w-[300px] min-h-[160px] mb-4 border bg-slate-300 rounded md:w-auto justify-center items-center inline-flex">
                @if (isset($image))
                    <img class="object-cover w-full h-full" src="{{ $image }}" alt="random user">
                @else
                    <div
                        class="inline-flex items-center justify-center object-cover h-full text-4xl rounded-lg text-slate-400">
                        {{-- Image --}}
                    </div>
                @endif
            </div>
        </div>

        <div class="px-12 pl-1">
            <div class="text-lg font-bold text-gray-700">
                {{ $name ?? 'No Name' }}
            </div>

            <div class="text-sm font-semibold text-gray-400">
                {{ $content ?? 'No Content' }}
            </div>
        </div>

        {{-- button --}}
        <div class="flex items-center justify-center mt-3">
            <a href="{{ route('dashboard') }}"
                {{-- class="px-4 py-2 text-sm w-[7.5rem] h-[2rem] flex justify-center items-center font-semibold text-white rounded-sm bg-blue-950 hover:bg-amber-600"> --}}
                class="px-4 py-2 text-sm w-[7.5rem] h-[2rem] flex justify-center items-center font-semibold text-white rounded-sm bg-blue-950 hover:drop-shadow-[3px_3px_1px_gray]">
                {{ $button ?? 'Tambah + ' }}
            </a>
        </div>
    </div>
</div>
