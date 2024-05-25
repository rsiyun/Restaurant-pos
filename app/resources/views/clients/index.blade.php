@extends('layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8">
        {{-- CARAOUSEL --}}
        <div class="mt-[2rem] mb-[1rem]">
            @include('components.h1-component', [
                'slot' => 'Menu Makanan',
                'bg' => 'amber-500',
            ])
        </div>

        {{-- CARD PRODUCT --}}
        <div class="h-[400px] flex flex-wrap items-center justify-around">
            @include('components.small-card-content', [
                'foto' =>
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU',
                'name' => 'Geprek Mbak Yuli',
                'content' => 'Geprek Ayam Hitam',
            ])

            @include('components.small-card-content', [
                'foto' =>
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBBB7CtPq6b__rtghwurMasUX-bXbFV1IUHg&s',
                'name' => 'Nasi Goreng Jawa',
                'content' => 'Pure Jawa NoFek',
            ])

            @include('components.small-card-content', [
                'foto' =>
                    'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSQkH3d6lBT-R9Zg79zXeZhXW8orwgU1hxkGhF00xoa4cKTqiNH',
                'name' => 'Gudek Berkah',
                'content' => 'Lejat Bergiji',
            ])

            @include('components.small-card-content', [
                'foto' =>
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU',
                'name' => 'Geprek Mbak Yuli',
                'content' => 'Geprek Ayam Hitam',
            ])

            @include('components.small-card-content', [
                'foto' =>
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBBB7CtPq6b__rtghwurMasUX-bXbFV1IUHg&s',
                'name' => 'Nasi Goreng Jawa',
                'content' => 'Pure Jawa NoFek',
            ])

            @include('components.small-card-content', [
                'foto' =>
                    'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSQkH3d6lBT-R9Zg79zXeZhXW8orwgU1hxkGhF00xoa4cKTqiNH',
                'name' => 'Gudek Berkah',
                'content' => 'Lejat Bergiji',
            ])
        </div>

        <div class="h-[100vh] pt-[10rem]">
            @include('components.h1-component', [
                'slot' => 'Langganane Arek-Arek ',
                'bg' => 'bg-amber-500',
            ])
        </div>
    @endsection
