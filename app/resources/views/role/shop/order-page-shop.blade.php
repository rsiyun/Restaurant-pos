<x-app-layout>

    {{-- ORDER --}}

    <x-slot name="header">

        {{-- FILTER --}}
        <div class=" flex justify-between items-center h-[4rem] w-[65.5rem] " style="margin: auto;">
            <div class="border w-48">
                <x-dropdown align="left" width="48">

                    <x-slot name="trigger">

                        {{-- Button Trigger Called Account --}}
                        <button
                            class="inline-flex items-center flex drop-shadow-[3px_3px_1px_grey] w-48 justify-between items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent hover:text-gray-700 focus:outline-none">
                            {{-- class="border flex justify-between items-center  px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none"> --}}
                            <div class="flex justify-between w-[10rem] ">

                                <div>{{ Auth::user()->name ?? 'Akun' }}</div>

                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                    </x-slot>

                    {{-- CONTENT --}}
                    <x-slot name='content'>
                        <x-dropdown-link :href="route('order-page')">
                            {{ __('Makanan') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('order-page')">
                            {{ __('Minuman') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('order-page')">
                            {{ __('Jajan') }}
                        </x-dropdown-link>
                    </x-slot>

                </x-dropdown>
            </div>

            <div class="flex justify-between items-center w-[30rem] ml-[-2rem]">
                <x-text-input id="search-produk" class="block w-[23rem] h-[2.1rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black" type="text" name="search-produk" placeholder="Cari produk yang kamu inginkan" />

                <x-primary-button class=" rounded-sm border mt-1 w-[5rem] h-[2rem] bg-blue-950 duration-300 ease-in-out hover:drop-shadow-[3px_3px_1px_grey] border">
                    <p class="flex justify-center w-full normal-case text-sm font-mediu">
                        <span>
                            {{ __('Cari') }}
                        </span>
                    </p>

                </x-primary-button>
            </div>

            <div class="mr-[4.5rem]">
                <x-primary-button class=" rounded-sm border mt-1 w-[7rem] h-[2rem] bg-blue-950 duration-300 ease-in-out hover:drop-shadow-[3px_3px_1px_grey] border">
                    <p class="flex justify-center w-full normal-case text-sm font-mediu">
                        <span>
                            {{ __('Tambah +') }}
                        </span>
                    </p>
                </x-primary-button>
            </div>
        </div>

        {{-- CARD PRODUK --}}
        <div class="flex justify-center mb-[2rem]">
            <div class="flex inline-grid justify-center grid-cols-3 gap-12">
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
                @include('components.cards.cards-2', ['name' => 'Nasi Goreng', 'content' => 'Rp. 12.000'])
            </div>
        </div>

    </x-slot>

</x-app-layout>
