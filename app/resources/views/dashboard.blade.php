<x-app-layout>

    <x-slot name="header">

        {{-- <h2 class="text-xl font-semibold leading-tight text-gray-800 flex justify-center">
            {{ __('Toko') }}
        </h2> --}}

        {{-- <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- CARD PRODUK --}}
        <div class="flex justify-center">
            <div class="inline-grid grid-cols-3 gap-12 flex justify-center">
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                {{-- @include('components.cards.cards-1', ['name' => 'Card 2', 'content' => 'Content 2']) --}}
            </div>
        </div>

        {{-- INFO --}}
        <div class="h-16 mt-[4rem] mb-[1.5rem] flex justify-center items-center">
            <div class="footer border h-[3rem] w-[37rem] bg-blue-950 flex items-center duration-300 ease-in-out justify-around rounded-sm shadow-[2px_2px_1px_gainsboro]">

                <div class="flex justify-between items-center h-[3rem] w-[8rem]">
                    {{-- <img src="{{asset('img/logo/Group 11.png')}}" alt="" class="max-w-[2rem]"> --}}
                    <h5 class="text-white">Total Produk</h5>
                </div>

                <div class="">
                    <h1 class="text-white">2</h1>
                </div>
            </div>
        </div>
    </x-slot>

</x-app-layout>
