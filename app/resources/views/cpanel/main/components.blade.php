@extends('cpanel.layout.app')

@section('content')
    @include('components.h1-component', [
        'bg' => 'blue-500',
        'textColor' => 'white',
        'title' => 'Dashboard',
    ])

    <div class="mb-5"></div>
    @include('components.buttons.btn-all', [
        'url' => 'tombol',
        'title' => 'Create new user',
    ])

    <div class="mb-5"></div>

@endsection
