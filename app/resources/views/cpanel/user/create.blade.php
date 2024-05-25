@extends('cpanel.layout.app')

@section('content')
    Form Pembuatan User (Registrasi)

    <form action="{{ url('dashboard/user') }}" method="POST">
        @csrf
        <div class="flex flex-col gap-4">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col gap-4">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col gap-4">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col gap-4">
            <label for="role">Role</label>
            <select name="role" id="role" class="px-4 py-2 border border-gray-300 rounded-md">
                <option value="Admin">Admin</option>
                <option value="Kasir">Kasir</option>
                <option value="ShopEmployee">ShopEmployee</option>
            </select>
        </div>

        <div class="flex flex-col gap-4">
            <label for="status">Status</label>
            <select name="status" id="status" class="px-4 py-2 border border-gray-300 rounded-md">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Tambah User
        </button>
@endsection
