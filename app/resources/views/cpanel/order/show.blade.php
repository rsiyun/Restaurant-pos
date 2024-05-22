@extends("cpanel.layout.app")
@section("content")
<p>idOrder: {{$data["slug"]}}</p>
    @foreach ($data["tickets"] as $ticket)
        <div class="flex gap-4">
            <p>Nama Toko: {{$ticket["shop"]["shopName"]}}</p>
            <p>idTicket: {{$ticket["slug"]}}</p>
        </div>
        @foreach ($ticket["ticketDetail"] as $ticketDetail)
            <p>{{$ticketDetail["product"]["productName"]}} : {{$ticketDetail["product"]["productPrice"]}}</p>
        @endforeach
    @endforeach

@endsection
