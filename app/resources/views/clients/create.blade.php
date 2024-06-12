@extends('clients.layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh]">
        @error('idShop')
            <div class="text-red-600">Silahkan login terlebih dahulu</div>
        @enderror

        @if ($errors->first('message'))
                <div class="p-4 mt-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                    <div>{{ $errors->first('message') }}</div>
                </div>
        @endif

        <x-texts.h1-dashboard title="Tambah Produk" subtitle="Form" />

        <form action="{{ url('/product') }}" method="POST" class="space-y-3" enctype="multipart/form-data">
            @csrf
            <x-forms.label-with-input label="Nama Produk" name="productName" type="text" :value="old('productName')"
                :error="$errors->first('productName')" required />
            <x-forms.label-with-input label="Harga Produk" name="productPrice" type="number" :value="old('productPrice')"
                :error="$errors->first('productPrice')" required />
            <x-forms.label-with-input label="Stok Produk" name="productStock" type="number" :value="old('productStock')"
                :error="$errors->first('productStock')" required />
            <x-forms.label-with-input label="Gambar produk" name="productImage" type="file" :value="old('productImage')"
                :error="$errors->first('productImage')" />

            <x-forms.input-select required :options="['Makanan' => 'Makanan', 'Minuman' => 'Minuman', 'Snack' => 'Snack']" name="productType" label="Jenis Produk" />
            <div class="pt-8">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>
@endsection
