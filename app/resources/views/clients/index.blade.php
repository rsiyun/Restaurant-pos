@extends('clients.layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh]">
        {{-- Section Controls --}}
        <div class="flex justify-between mt-8">
            <div class="flex flex-col gap-4 w-[13rem]">
                @include('components.dropdown.dropdown', [
                    'title' => 'Kategori',
                    'name' => 'category',
                    'id' => 'category',
                    'options' => [
                        '1' => 'Makanan',
                        '2' => 'Minuman',
                        '3' => 'Jajan',
                    ],
                ])
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

        {{-- Border separator --}}
        <div class="my-2 border-b border-gray-300"></div>

        {{-- Main Content --}}
        <div class="grid justify-center grid-cols-4 gap-3">
            @foreach ($products as $product)
                <div class="inline-flex items-center justify-center ">
                    @include('components.small-card-content', [
                        'foto' => SessionService::image_url() . $product['productImage'] ?? "",
                        'name' => $product['productName'],
                        'content' => 'Rp. ' . $product['productPrice'],
                        'link' => url('/product' . '/' . $product['slug']),
                    ])
                </div>
            @endforeach
        </div>

    </div>
@endsection
