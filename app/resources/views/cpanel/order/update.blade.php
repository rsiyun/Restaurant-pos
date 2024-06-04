@extends('cpanel.layout.app')

@section('content')
    <form action="{{ url('dashboard/order/' . $slug) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="BuyerName">Buyer Name:</label>
            <input type="text" id="BuyerName" name="buyerName" required value="{{ $buyerName }}">
        </div>

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
                @foreach ($unPayment as $ticket)
                    @php
                        $isActive = false;
                        foreach ($oldTickets as $oldTicket) {
                            if ($oldTicket['slug'] === $ticket['slug']) {
                                $isActive = true;
                                break;
                            }
                        }
                    @endphp
                    <tr class="bg-gray-100 border-b text-center">
                        <td class="py-3 px-4 text-center">
                            <input name="tickets[]" value="{{ $ticket['slug'] }}" type="checkbox"
                                class="form-checkbox h-4 w-4 text-blue-600"
                                @if ($isActive) checked @endif>
                        </td>
                        <td class="py-3 px-4">{{ $ticket['slug'] }}</td>
                        <td class="py-3 px-4">{{ $ticket['shop']['shopName'] }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
