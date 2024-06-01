@extends('clients.layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh]">

        <div class="flex justify-between mt-8 border">

            <div class="flex flex-col gap-4 w-[13rem]">
                <select id="" name=""
                    class="border-gray-300 rounded-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option class="rounded-sm" value="1">Kategori</option>
                    <option class="rounded-sm" value="1">Makanan</option>
                    <option class="rounded-sm" value="2">Minuman</option>
                    <option class="rounded-sm" value="3">Jajan</option>
                </select>
            </div>

            <div class="flex content-center justify-center gap-6 items-middle">
                <input type="text" class="w-[20rem] h-10 bg-gray-200 rounded-sm">

                <button
                    class="px-4 py-2 font-bold text-white transition w-[6rem] duration-300 ease-in-out bg-sky-900 rounded-sm hover:drop-shadow-lg">
                    Search
                </button>
            </div>

            <div class="">
                <x-buttons.action-link title="Tambah Produk" href="{{ url('/product/create') }}" />
            </div>
        </div>

        <div class="pb-8">
            <div class="flex flex-wrap items-center justify-center">
                @foreach ($products as $product)
                    <div class="px-8">
                        @include('components.small-card-content', [
                            'foto' => SessionService::image_url() . $product['productImage'],
                            'name' => $product['productName'],
                            'content' => 'Rp. ' . $product['productPrice'],
                            'link' => url('/product' . '/' . $product['slug']),
                        ])
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
