@extends('clients.layouts.app')

@section('slot')
    <div class="min-h-screen py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-12"></div>
        <div class="grid grid-cols-3 gap-4 max-w-7xl sm:px-6 lg:px-8">
            {{-- CAROUSEL --}}
            <div class="overflow-hidden bg-withe w-3/10 h-[250px] items-center rounded-md border-2 border-grey">
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

                        <a href="{{ url('product/' . $product['slug'] . '/edit') }}" class="py-3 px-4 text-white bg-blue-900 rounded-sm hover:drop-shadow-lg">
                            Edit
                        </a>
                    </div>
                </div>
            </div>

            {{-- CONTROL PANEL --}}
            <div id="control" class="flex flex-col justify-around p-4 bg-white border rounded-md shadow-md w-[20rem]">
                <p class="mb-2 text-center">
                    Atur jumlah yang diinginkan
                </p>
                <form method="POST" action="{{ url('/cart/add/' . $product['slug']) }}">
                    @csrf
                    <div class="flex flex-col">
                        <input type="number" name="quantity" class="p-2 mb-4 border rounded-sm" placeholder="Jumlah"
                            min="1" max="{{ $product['productStock'] }}" required>
                        <button type="submit" class="p-2 text-white bg-blue-900 rounded-sm hover:drop-shadow-lg">
                            Tambahkan ke keranjang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
