@extends('cpanel.layout.app')

@section('content')

    <form action="{{ url('dashboard/order') }}" method="POST">
        @csrf
        <div>
            <label for="buyerName">Buyer Name:</label>
            <input type="text" id="buyerName" name="buyerName" required>
        </div>
        <table class="min-w-full bg-white shadow-md rounded-lg mt-[20px]">
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
            <button type="submit" class="px-4 py-2 mt-[20px] text-white bg-blue-600 rounded-md hover:bg-blue-700">Submit</button>
        </div>
    </form>
@endsection
