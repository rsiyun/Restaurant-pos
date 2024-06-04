@extends('cpanel.layout.app')
@section('content')
    <div class="flex justify-end">
        <div class="flex gap-4">
            <a
                href="{{ url('/dashboard/shop') }}{{ '/' . $data['slug'] . '/edit' }}"class="px-4 py-2 bg-blue-500 rounded text-white">update</a>
            <form action="{{ url('/dashboard/shop/' . $data['slug']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 rounded text-white"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
            </form>
        </div>
    </div>
    <p>Id Toko: {{ $data['slug'] }}</p>
    <p>Nama Toko: {{ $data['shopName'] }}</p>
    <p>Pemilik Toko: {{ $data['ownerName'] }}</p>
    @if ($data['isActive'])
        <p>Status Toko: active</p>
    @else
        <p>Status Toko: Non active</p>
    @endif


    <table class="w-full text-left border-collapse rounded table-auto">
        <thead>
            <tr>
                <th
                    class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                    No
                </th>
                <th
                    class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                    Foto
                </th>
                <th
                    class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                    Nama Produk
                </th>
                <th
                    class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                    Harga Produk</th>
            </tr>
        </thead>

        <tbody>
            @if (isset($data))
                @foreach ($data['products'] as $product)
                    <tr class="border border-slate-400">
                        <td class="px-4 py-3">
                            {{ $product['idProduct'] }}
                        </td>
                        <td class="px-4 py-3">
                            <img src="{{ SessionService::image_url() . $product['productImage'] }}" alt="gambar produk" class="max-w-[5rem]">
                        </td>
                        <td class="px-4 py-3">
                            {{ $product['productName'] }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $product['productPrice'] }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="px-4 py-3 text-center">No Product found.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
