@extends('cpanel.layout.app')

@section('content')

    <form action="{{ url('dashboard/order') }}" method="POST">
        @csrf
        <div>
            <label for="idKasir">Kasir ID:</label>
            <input type="number" id="idKasir" name="idKasir" required>
        </div>
        <div>
            <label for="buyerName">Buyer Name:</label>
            <input type="text" id="buyerName" name="buyerName" required>
        </div>
        <div>
            <label for="tickets">Select Tickets:</label><br>
            @foreach ($tickets as $ticket)
                <input type="checkbox" id="ticket_{{ $ticket['slug'] }}" name="tickets[][slugTicket]"
                    value="{{ $ticket['slug'] }}">
                <label for="ticket_{{ $ticket['slug'] }}">{{ $ticket['slug'] }}</label><br>
            @endforeach
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
