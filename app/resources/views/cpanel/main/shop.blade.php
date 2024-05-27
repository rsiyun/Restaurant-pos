@extends('cpanel.layout.app')


{{-- TODO: Nanti dipindah ke folder cpanel/layout/shop/index --}}
@section('content')
    <div class="pb-8">
        <h2 class="text-2xl font-bold text-right text-blue-600">
            {{-- Hai, {{ $profile['name'] ?? 'Developer' }}! --}}
        </h2>
    </div>

    @include('components.texts.h1-dashboard', [
        'title' => "Toko",
        'subtitle' => "Dashboard"
    ])

    <div class="my-4 border-b border-gray-300"></div>

    {{-- Search --}}
    <div class="flex flex-col">
        <div class="my-2">
            <input type="searchShop" name="searchShop" id="searchShop" class="px-4 py-2 mb-2 border border-gray-300 rounded-md" placeholder="Cari Toko">
            <button action="" class="px-4 py-2 text-white bg-blue-800 rounded-md hover:bg-blue-700" >
                Cari
            </button>
        </div>
    </div>

    {{-- Sementara hidden nunggu kepastian dari UI --}}
    <div class="flex-row justify-start hidden gap-5 pb-5 ">
        <select name="role" id="role"
            class="px-4 py-2 text-black border-blue-500 rounded-md shadow-sm appearance-none min-w-2 focus:outline-none focus:ring-1 w-[12rem]">
            <option value="" disabled selected>Sortir berdasarkan</option>
            <option value="admin">Nama</option>
            <option value="user">Email</option>
            <option value="status">Status</option>
        </select>

        <a href="{{ url('/dashboard/user/create') }}" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Tambah User
        </a>
    </div>

    @php
        $users = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'Admin', 'isActive' => 1, 'slug' => 'john-doe'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'User', 'isActive' => 0, 'slug' => 'jane-smith'],
            // Add more static users if needed
        ];
    @endphp

    @include('components.user-table', ['users' => $users])
@endsection
