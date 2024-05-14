<div class="flex drop-shadow-lg items-center justify-center h-[15rem] gap-6 mt-4 bg-white-700 rounded-xl border border-red-700">
    {{ $slot ?? 'No Label Input' }}
    <input type="text" class="w-[20rem] h-10 bg-gray-200 rounded-lg"
        placeholder="{{ $placeHolder ?? 'Search for food' }}">

    <button class="px-4 py-2 font-bold text-white transition-colors duration-100 bg-red-700 rounded hover:bg-white hover:text-red-700">
        {{ $buttonText ?? 'Search' }}
    </button>
</div>
