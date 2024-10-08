@extends('cpanel.layout.app')

@section('content')
    Form Pembuatan User (Registrasi)

    @if ($errors->first('message'))
        <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
            <div>{{ $errors->first('message') }}</div>
        </div>
    @endif

    <form action="{{ url('dashboard/user') }}" method="POST">
        @csrf

        <x-forms.label-with-input label="Name" name="name" type="text" :value="old('name')" :error="$errors->first('name')" required />
        <x-forms.label-with-input label="Email" name="email" type="text" :value="old('email')" :error="$errors->first('email')" required />
        <x-forms.label-with-input label="Password" name="password" type="text" :value="old('password')" :error="$errors->first('password')"
            required />
        <x-forms.input-select :options="['Admin' => 'Admin', 'Kasir' => 'Kasir', 'ShopEmployee' => 'ShopEmployee']" name="role" label="Role" required />
        <x-forms.input-select :options="['active' => 'active', 'inactive' => 'inactive']" name="status" label="Status" />

        <div class="pt-8">
            <button type="submit" class="px-4 py-2 text-white bg-blue-900 duration-300 ease-in-out rounded-sm hover:drop-shadow-[3px_3px_1px_grey]">
                Tambah User
            </button>
        </div>
    @endsection
