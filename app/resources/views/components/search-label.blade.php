{{-- <div class="flex drop-shadow-lg items-center justify-center h-[15rem] gap-6 mt-4 bg-white-700 rounded-xl border border-red-700"> --}}

{{-- <div class="flex justify-center h-[90rem] rounded-xl border border-red-700"> --}}

    <div class="flex flex-col drop-shadow-lg items-center justify-center h-[10rem] w-[35rem] gap-6 mt-4 bg-white rounded-xl border border-white-700">

        {{ $slot ?? 'No Label Input' }}

        <div class="flex justify-center content-center items-middle gap-6">
            <input type="text" class="w-[20rem] h-10 bg-gray-200 rounded-lg"
                placeholder="{{ $placeHolder ?? 'Search for food' }}">

            <button
                class="px-4 py-2 font-bold text-white transition-colors duration-100 bg-red-700 rounded hover:bg-white hover:text-red-700">
                {{ $buttonText ?? 'Search' }}
            </button>
        </div>
    </div>
{{-- </div> --}}
