@extends('layouts.app')

@section('slot')
    <div class="flex flex-col h-screen">
        <div class="mt-[1rem] mb-[1rem]">
            @include('components.h1-component', [
                'slot' => 'Nama Makanan 1',
                'bg' => '',
                'textColor' => 'black',
            ])
        </div>
        <div class="mb-12">

        </div>
        <div class="grid grid-cols-3 gap-4 grid-col max-w-7xl sm:px-6 lg:px-8">
            {{-- CARAOUSEL --}}
            <div class="inline-flex flex-1 w-12 h-12 bg-red-500">
                <img src="{{ asset('img/logo/Group 11.png') }}" alt="">
            </div>

            {{-- CARD PRODUCT --}}
            <div id="texts" class="">
                {{-- Image --}}
                {{-- Image Description --}}

                <p class="text-4xl font-bold">
                    Title
                </p>

                <p>
                    Price
                </p>

                <p>
                    Stock
                </p>
            </div>

            <div id="control" class="inline-flex flex-col bg-white border shadow flex-2">
                <p>
                    Atur jumlah yang diinginkan
                </p>

                <input type="number">


                <button>
                    Tambahkan ke keranjang
                </button>

            </div>
        </div>
    </div>
@endsection
