@extends('layouts.shop-layout')

{{-- PRODUK --}}

@section('slot')
    <div class="relative mt-[2rem] mb-[9.5rem]">{{-- PARENT --}}
        {{-- CARAOUSEL --}}
        @include('components.h1-component', [
            'slot' => 'Menu Makanan',
            'bg' => 'bg-red-700',
        ])

        {{-- SEARCH --}}
        <div class="absolute flex items-center justify-center bottom-0 mb-[-4.5rem] w-[76rem]">{{-- CHILD --}}
            @include('components.search-label', [
                'slot' => 'Cari Menu Apa??',
                'placeHolder' => 'Isikan disini',
                'buttonText' => 'Cari',
            ])
        </div>
    </div>
@endsection
