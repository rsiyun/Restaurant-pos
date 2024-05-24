@extends('cpanel.layout.app')

@section('content')

    <form action="{{ url('dashboard/order') }}" method="POST">
        @csrf
        <div>
            <label for="buyerName">Buyer Name:</label>
            <input type="text" id="buyerName" name="buyerName" required>
        </div>
        {{-- <div>
            <label for="tickets">Select Tickets:</label><br>
            @foreach ($tickets as $ticket)
                <input type="checkbox" id="ticket_{{ $ticket['slug'] }}" name="tickets[][slugTicket]"
                    value="{{ $ticket['slug'] }}">
                <label for="ticket_{{ $ticket['slug'] }}">{{ $ticket['slug'] }}</label><br>
            @endforeach
        </div> --}}
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-3 px-4">
                        choose
                    </th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Id Ticket</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Shop Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr class="bg-gray-100 border-b text-center">
                    <td class="py-3 px-4 text-center">
                        <input name="tickets[]" value="{{$ticket['slug']}}" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                    </td>
                    <td class="py-3 px-4">{{ $ticket['slug'] }}</td>
                    <td class="py-3 px-4">{{$ticket['shop']['shopName']}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
