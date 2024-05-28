@extends('cpanel.layout.app')

@section('content')
    Form Pembuatan Toko (Registrasi)

    <form action="{{ url('dashboard/shop') }}" method="POST">
        @csrf
        <div class="flex flex-col gap-4">
            <label for="name">Nama Pemilik</label>
            <input type="text" name="name" id="name" class="px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col gap-4">
            <label for="name">Nama Toko</label>
            <input type="text" name="name" id="name" class="px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="pt-8">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Tambah toko
            </button>
        </div>
@endsection
