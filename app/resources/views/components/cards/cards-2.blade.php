<div class="" id="container-card-2">
    <div {{-- class="p-[1.1vh] mt-7 w-min-[18rem] h-min-[15rem] bg-white rounded-lg shadow-lg hover:drop-shadow-xl duration-300 ease-in-out cursor-pointer flex-col inline-flex border justify-center"> --}}
        class="p-[1.1vh] mt-7 h-[15rem] rounded-sm shadow-[3px_3px_3px_gainsboro] duration-300 ease-in-out flex-col inline-flex border justify-center">

        {{-- <a href=""> --}}
        {{-- <div class="flex items-center justify-between mt-[1rem] border mb-[-2rem]"> --}}
        {{-- class="min-w-[300px] min-h-[160px] mb-4.5 border bg-slate-300 rounded shadow-md md:w-auto justify-center items-center inline-flex"> --}}
        {{-- <div
            class="min-w-[300px] mt-[-2.6rem] min-h-[160px] mb-4 border bg-slate-300 rounded md:w-auto justify-center items-center inline-flex">
            @if (isset($image))
                <img class="object-cover w-full h-full" src="{{ $image }}" alt="random user">
            @else
                <div
                    class="inline-flex items-center justify-center object-cover h-full text-4xl rounded-lg text-slate-400">
                </div>
            @endif
        </div> --}}
        {{-- Image --}}

        <div class="border h-[160px] w-[300px] bg-slate-300 rounded">

        </div>

        <div class=" h-[4rem]">
            <div class="text-xl font-black text-gray-700">
                {{ $name ?? 'No Name' }}
            </div>

            <div class="grid justify-items-end ">
                <div class="text-xl font-extrabold text-gray-700">
                    {{ $content ?? 'No Content' }}
                </div>
            </div>
        </div>
        {{-- </div> --}}

        {{-- <div class="px-12 pl-1 border flex flex-col justify-between">
                <div class="text-xl font-black text-gray-700">
                    {{ $name ?? 'No Name' }}
                </div>


                <div class="grid justify-items-end ">
                    <div class="text-xl font-extrabold text-gray-700 border mr-[-3rem]">
                        {{ $content ?? 'No Content' }}
                    </div>
                </div>
            </div> --}}
        {{-- </a> --}}

        {{-- button --}}
        {{-- class="px-4 py-2 text-sm w-[7.5rem] h-[2rem] flex justify-center items-center font-semibold text-white rounded-sm bg-blue-950 hover:bg-amber-600"> --}}
        {{-- <div class="flex items-center justify-center mt-3">
            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 text-sm w-[7.5rem] h-[2rem] flex justify-center items-center font-semibold text-white rounded-sm bg-blue-950 hover:drop-shadow-[3px_3px_1px_gray]">
                {{ $button ?? 'Tambah + ' }}
            </a>
        </div> --}}
    </div>
</div>
