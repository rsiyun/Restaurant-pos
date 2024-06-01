@extends('clients.layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh]">
        <x-texts.h1-dashboard title="Tambah Produk" subtitle="Form" />

        {{-- Shop Employee Information --}}
        {{-- {{ $profile['idUser'] }}
        {{ $profile['userRole'] }}
        {{ $profile['shopId'] }}
        {{ $profile['shopName'] }} --}}

        {{-- Form --}}

        <form action="{{ url('/product') }}" method="POST" class="space-y-3">
            @csrf
            {{-- Nama Produk --}}
            <x-forms.label-with-input label="Nama Produk" name="productName" type="text" />

            {{-- Harga Produk --}}
            <x-forms.label-with-input label="Harga Produk" name="productPrice" type="text" />

            {{-- Gambar Produk --}}
            {{-- <x-forms.label-with-input label="Gambar Produk" name="productImage" type="image" /> --}}

            {{-- Produk Stok --}}
            <x-forms.label-with-input label="Stok Produk" name="productStock" type="number" />

            <div class="flex flex-col gap-4">
                <label for="productType">Jenis Produk</label>
                <select name="productType" id="productType" class="px-4 py-2 border border-gray-300 rounded-md">
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Snack">Snack</option>
                </select>
            </div>

            <div class="pt-8">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>
@endsection
