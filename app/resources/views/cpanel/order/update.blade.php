@extends('cpanel.layout.app')

@section('content')
    <form action="{{ url('dashboard/order') }}" method="POST">
        @csrf
        @method("PUT")
        <div>
            <label for="idKasir">Kasir ID:</label>
            <input type="number" id="idKasir" name="idKasir" required value="{{$idKasir}}">
        </div>
        <div>
            <label for="BuyerName">Buyer Name:</label>
            <input type="text" id="BuyerName" name="BuyerName" required value="{{$buyerName}}">
        </div>
        @foreach ($oldTickets as $oldTicket)
            <div class="flex gap-4">
                @foreach ($oldTicket['ticketDetail'] as $ticketDetail)
                <div class="border border-black p-4 gap-4 inline-flex justify-center items-center">
                    <p>{{ $oldTicket['shop']['shopName'] }}</p>
                    <p>{{ $ticketDetail['product']['productName'] }} : {{ $ticketDetail['product']['productPrice'] }}</p>
                </div>
            @endforeach
            </div>
        @endforeach

        <form action="" method="GET">
            <div>
                <label for="">search</label>
                <input type="text">
            </div>
        </form>
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
                @foreach ($unPayment["tickets"] as $ticket)
                <tr class="bg-gray-100 border-b text-center">
                    <td class="py-3 px-4 text-center">
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                    </td>
                    <td class="py-3 px-4">{{ $ticket['slug'] }}</td>
                    <td class="py-3 px-4">{{$ticket['shop']['shopName']}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>

        @for ($i = 1; $i <= $unPayment["lastpage"]; $i++)
            <a href="{{ url('dashboard/order/'.$slug.'/edit?page=' . $i) }}">{{$i}}</a>
        @endfor



        {{-- <div>
            <label for="orderSlug">Pilih Order yang Akan Ditambah:</label>
            <select name="orderSlug" id="orderSlug" required>
                @foreach ($unPayment["tickets"] as $ticket)
                    <option value="{{ $ticket['slug'] }}">{{ $ticket['slug'] }}</option>
                @endforeach
            </select>
        </div> --}}
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
