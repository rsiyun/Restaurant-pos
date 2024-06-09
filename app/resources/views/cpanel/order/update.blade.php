@extends('cpanel.layout.app')

@section('content')
    <form action="{{ url('dashboard/order/' . $slug) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="w-[150px]">
            <x-forms.label-with-input label="Buyer Name :" name="buyerName" type="text" :value="$buyerName" />
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
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 mt-[20px]">Submit</button>
        </div>
    </form>
@endsection
