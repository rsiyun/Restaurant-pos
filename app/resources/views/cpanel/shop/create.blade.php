@extends('cpanel.layout.app')

@section('content')
    <h4 class="pb-4 text-2xl font-bold">Form Pembuatan Toko</h4>
    <form action="{{ url('dashboard/shop') }}" method="POST">
        @csrf
        <x-forms.label-with-input label="Nama Pemilik" name="ownerName" type="text" :value="old('ownerName')" :error="$errors->first('ownerName')" required/>
        <x-forms.label-with-input label="Nama Toko" name="shopName" type="text" :value="old('shopName')" :error="$errors->first('shopName')" required/>

        <div>
            <button type="submit" class="px-4 py-2 text-white duration-300 ease-in-out bg-blue-900 rounded-sm  hover:drop-shadow-[3px_3px_1px_grey]">
                Tambah toko
            </button>
        </div>
@endsection
