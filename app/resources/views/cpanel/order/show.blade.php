@extends('cpanel.layout.app')
@section('content')
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

    <form action="{{ url('/dashboard/order/' . $data['slug']) }}" method="POST">
        @csrf
        @method('DELETE')
        <div>
            <label for="orderSlug">Pilih Order yang Akan Dihapus:</label>
            <select name="orderSlug" id="orderSlug" required>
                @foreach ($data['tickets'] as $ticket)
                    <option value="{{ $ticket['slug'] }}">
                        Nama Toko: {{ $ticket['shop']['shopName'] }}, idTicket: {{ $ticket['slug'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
    </form>
@endsection
