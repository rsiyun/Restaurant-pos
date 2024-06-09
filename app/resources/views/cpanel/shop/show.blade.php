@extends('cpanel.layout.app')
@section('content')
    <div class="flex justify-end">
        <div class="flex gap-4">
            <a href="{{ url('/dashboard/shop') }}{{ '/' . $data['slug'] . '/edit' }}"class="px-4 py-2 bg-blue-500 rounded text-white">update</a>
        </div>
    </div>

    <div class="pb-4">
        <div class="w-[300px] mt-[-90px] pl-[10px] pt-[10px] space-y-1 rounded bg-white shadow-md">
            <div class="py-2 px-2">
                <p class="pb-2"><strong>Id Toko:</strong> {{ $data['slug'] }}</p>
                <p class="pb-2"><strong>Nama Toko:</strong> {{ $data['shopName'] }}</p>
                <p class="pb-2"><strong>Pemilik Toko:</strong> {{ $data['ownerName'] }}</p>
                @if ($data['isActive'])
                    <p><strong>Status Toko:</strong> active</p>
                @else
                    <p><strong>Status Toko:</strong> Non active</p>
                @endif
            </div>
        </div>
    </div>


    <x-tables.table>

        <table id="table" class="w-full border-collapse rounded table-auto">
            <thead>
                <tr>
                    <th
                        class="font-medium text-black border bg-white capitalize border-slate-400">
                        No
                    </th>
                    <th
                        class="font-medium text-black border bg-white capitalize border-slate-400">
                        Foto
                    </th>
                    <th
                        class="font-medium text-black border bg-white capitalize border-slate-400">
                        Nama Produk
                    </th>
                    <th
                        class="font-medium text-black border bg-white capitalize border-slate-400">
                        Harga Produk</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                    @foreach ($data['products'] as $product)
                        <tr class="border border-slate-400">
                            <td class="px-4 py-3 border border-slate-400">
                                {{ $loop->iteration ?? 0 }}
                            </td>
                            <td class="px-4 py-3 border border-slate-400">
                                <img src="{{ SessionService::image_url() . $product['productImage'] }}" alt="gambar produk"
                                    class="max-w-[5rem]">
                            </td>
                            <td class="px-4 py-3 border border-slate-400">
                                {{ $product['productName'] }}
                            </td>
                            <td class="px-4 py-3 border border-slate-400">
                                {{ $product['productPrice'] }}
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </x-tables.table>

@endsection
