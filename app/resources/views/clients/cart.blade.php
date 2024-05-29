@extends('clients.layouts.app')

@section('slot')
    <div class="min-h-screen py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-12"></div>
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>
            <a href="/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Kembali</a>
            @if ($cartItems && count($cartItems) > 0)
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($cartItems as $item)
                        <div class="border p-4 rounded-md">
                            <p class="text-lg font-semibold">{{ $item['productName'] ?? 'Product Name Unavailable' }}</p>
                            <p>Harga: Rp {{ number_format($item['productPrice'] ?? 0, 2) }}</p>
                            <p>Jumlah: {{ $item['quantity'] ?? 0 }}</p>
                            <p>Total: Rp {{ number_format($item['total'] ?? 0, 2) }}</p>
                            <p>Tipe Makanan: {{ $item['productType'] ?? 'Tipe Makanan Kosong' }}</p>
                            <form action="{{ route('clients.removeFromCart', $item['slug'] ?? '') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <form action="{{ route('clients.clearSession') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded">Kosongkan Keranjang</button>
                </form>
            @else
                <p>Keranjang belanja Anda kosong.</p>
            @endif
        </div>
    </div>
@endsection
