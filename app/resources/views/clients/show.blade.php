@extends('clients.layouts.app')

@section('slot')
    <div class="min-h-screen py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-12"></div>
        <div class="grid grid-cols-3 gap-4 max-w-7xl sm:px-6 lg:px-8">
            {{-- CAROUSEL --}}
            <div class="overflow-hidden bg-red-800 w-3/10 h-[250px] items-center rounded-md border-2 border-red-500">
                <img src="{{ url(SessionService::image_url() . $product['productImage']) }}" alt=""
                    class="object-cover w-full h-full">
            </div>

            {{-- PRODUCT DETAILS --}}
            <div id="texts" class="flex flex-col justify-between w-4/10">
                <div>
                    <p class="mb-2 text-4xl font-bold">
                        {{ $product['productName'] }}
                    </p>
                    <p class="mb-4 text-xl text-gray-600">
                        Rp. {{ $product['productPrice'] }}
                    </p>
                    <p class="text-gray-500 text-md">
                        Stock : {{ $product['productStock'] }}
                    </p>
                </div>

                <div>
                    {{-- Action button --}}
                    <div class="mb-4">
                        <button class="p-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                            Edit
                        </button>
                        <button class="p-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            {{-- CONTROL PANEL --}}
            <div id="control" class="flex flex-col justify-between p-4 bg-white border rounded-md shadow-md w-[20rem]">
                <p class="mb-4">
                    Atur jumlah yang diinginkan
                </p>
                <!-- Form untuk menambahkan ke keranjang belanja -->
                <form method="POST" action="{{ url('/cart/add/' . $product['slug']) }}">
                    @csrf
                    <input type="number" name="quantity" class="p-2 mb-4 border rounded-md" placeholder="Jumlah"
                        min="1" max="{{ $product['productStock'] }}" required>
                    <button type="submit" class="p-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                        Tambahkan ke keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
