@extends('clients.layouts.app')
@section('slot')
<div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh]">
    @error('idShop')
        <div class="text-red-600">Silahkan login terlebih dahulu</div>
    @enderror
    <x-texts.h1-dashboard title="Edit data produk anda" subtitle="Form" />

    <form action="{{ url('product/' . $product['slug']) }}" method="POST" class="space-y-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-forms.label-with-input 
            label="Nama Produk" 
            name="productName" 
            type="text" 
            :value="old('productName', $product['productName'])" 
            :error="$errors->first('productName')" 
            required 
        />
        <x-forms.label-with-input 
            label="Gambar produk" 
            name="productImage" 
            type="file" 
            :value="old('productImage')" 
            :error="$errors->first('productImage')" 
        />
        <x-forms.label-with-input 
            label="Harga Produk" 
            name="productPrice" 
            type="number" 
            :value="old('productPrice', $product['productPrice'])" 
            :error="$errors->first('productPrice')" 
            required 
        />
        <x-forms.label-with-input 
            label="Stok Produk" 
            name="productStock" 
            type="number" 
            :value="old('productStock', $product['productStock'])" 
            :error="$errors->first('productStock')" 
            required 
        />
        <x-forms.input-select 
            required 
            :options="['Makanan' => 'Makanan', 'Minuman' => 'Minuman', 'Snack' => 'Snack']" 
            name="productType" 
            label="Jenis Produk" 
            :selected="old('productType', $product['productType'])"
        />
        <div class="pt-8">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Update Produk
            </button>
        </div>
    </form>
    
    </div>


    



@endsection