@extends('clients.layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh]">
        {{-- Section Controls --}}
        <form action="{{ url('/') }}" method="GET">
            <div class="flex justify-between items-center mt-8 mb-8">
                <div class="flex flex-col gap-4 w-[13rem]">
                    @include('components.dropdown.dropdown', [
                        'title' => 'Kategori',
                        'name' => 'type',
                        'id' => 'category',
                        'options' => [
                            '' => 'Product Type',
                            'Makanan' => 'Makanan',
                            'Minuman' => 'Minuman',
                            'Snack' => 'Snack',
                        ],
                    ])
                </div>

                <div class="flex content-center justify-center gap-6 items-middle">
                    <input type="text" class="w-[20rem] h-10 bg-gray-200 rounded-sm" name="s">

                    <button
                        class="px-4 py-2 text-white w-[6rem] duration-300 ease-in-out bg-sky-900 rounded-sm hover:drop-shadow-[3px_3px_1px_grey]">
                        Search
                    </button>
                </div>

                <div class="border h-10 flex items-center">
                    <x-buttons.action-link title="Tambah Produk" href="{{ url('/product/create') }}" />
                </div>
            </div>
        </form>

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
        @if ($links["last"] != $links["first"])
        <nav class="flex items-center py-8 space-x-1">
            <a class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100" href="{{ url('/?page=') }}{{$links['first']}}">
                first
            </a>
            @if ($links["next"])
            <a href="{{ url('/?page=') }}{{$links['next']}}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">next</a>
            @endif
            @if ($links["prev"])
            <a href="{{ url('/?page=') }}{{$links['prev']}}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">prev</a>
            @endif

            <a href="{{ url('/?page=') }}{{$links['last']}}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
                last
            </a>
        </nav>
        @endif
    </div>
@endsection
