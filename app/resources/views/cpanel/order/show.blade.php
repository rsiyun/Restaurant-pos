@extends('cpanel.layout.app')
@section('content')
<div class="flex justify-end">
    <div class="flex gap-4">
        <a href="{{ url('/dashboard/order') }}{{"/".$data['slug'] ."/edit" }}"class="px-4 py-2 bg-blue-500 rounded text-white">update</a>
        <form action="{{ url('/dashboard/order/' . $data['slug']) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 rounded text-white" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
        </form>
    </div>
</div>
    <p>idOrder: {{ $data['slug'] }}</p>
    @foreach ($data['tickets'] as $ticket)
        <div class="flex gap-4">
            <p>Nama Toko: {{ $ticket['shop']['shopName'] }}</p>
            <p>idTicket: {{ $ticket['slug'] }}</p>
        </div>
        @foreach ($ticket['ticketDetail'] as $ticketDetail)
            <p>{{ $ticketDetail['product']['productName'] }} : {{ $ticketDetail['product']['productPrice'] }}</p>
        @endforeach
    @endforeach

    <br>
    <br>

@endsection
