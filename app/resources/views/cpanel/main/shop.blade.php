@extends('cpanel.layout.app')

@section('content')
    <div class="pb-8">
        <h2 class="text-2xl font-bold text-right text-blue-600">
            Hai, {{ $profile['name'] ?? 'Developer' }}!
        </h2>
    </div>

    @include('components.search-label', [
        'slot' => 'tombol',
        'placeHolder' => 'Tambah Toko',
        'buttonText' => 'Cari',
    ])

    {{-- CONTAINER --}}
    <div class="border flex flex-wrap justify-around ">
        @include('components.small-card-content', [
            'foto' =>
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU',
            'name' => 'Geprek Mbak Yuli',
            'content' => 'Geprek Ayam Hitam',
            'link' => url('/1'),
        ])

        @include('components.small-card-content', [
            'foto' =>
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU',
            'name' => 'Geprek Mbak Yuli',
            'content' => 'Geprek Ayam Hitam',
            'link' => url('/1'),
        ])
        @include('components.small-card-content', [
            'foto' =>
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU',
            'name' => 'Geprek Mbak Yuli',
            'content' => 'Geprek Ayam Hitam',
            'link' => url('/1'),
        ])

        @include('components.small-card-content', [
            'foto' =>
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU',
            'name' => 'Geprek Mbak Yuli',
            'content' => 'Geprek Ayam Hitam',
            'link' => url('/1'),
        ])

        @include('components.small-card-content', [
            'foto' =>
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU',
            'name' => 'Geprek Mbak Yuli',
            'content' => 'Geprek Ayam Hitam',
            'link' => url('/1'),
        ])
        @include('components.small-card-content', [
            'foto' =>
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk6YT3yl9RRIPngQVW2DddDilawjVnW-XAdwM7XD-gwBqzjkX7D3BvG7jkBbkLMxHzXwI&usqp=CAU',
            'name' => 'Geprek Mbak Yuli',
            'content' => 'Geprek Ayam Hitam',
            'link' => url('/1'),
        ])
    </div>
@endsection
