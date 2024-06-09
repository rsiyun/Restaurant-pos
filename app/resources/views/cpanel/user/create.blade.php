@extends('cpanel.layout.app')

@section('content')
    Form Pembuatan User (Registrasi)

    <form action="{{ url('dashboard/user') }}" method="POST">
        @csrf
        
        <x-forms.label-with-input label="Name" name="name" type="text" :value="old('name')" :error="$errors->first('name')"/>
        <x-forms.label-with-input label="Email" name="email" type="text" :value="old('email')" :error="$errors->first('email')" />
        <x-forms.label-with-input label="Password" name="password" type="text" :value="old('password')" :error="$errors->first('password')" />
        <x-forms.input-select :options="['Admin' => 'Admin', 'Kasir' => 'Kasir', 'ShopEmployee' => 'ShopEmployee']" name="role" label="Role"/>
        <x-forms.input-select :options="['active' => 'active', 'inactive' => 'inactive']" name="status" label="Status"/>

        <div class="pt-8">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Tambah User
            </button>
        </div>
@endsection
