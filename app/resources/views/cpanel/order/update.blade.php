@extends('cpanel.layout.app')

@section('content')

    @if ($errors->first('message'))
        <div class="p-4 mt-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
            <div>{{ $errors->first('message') }}</div>
        </div>
    @endif

    <form action="{{ url('dashboard/order/' . $slug) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="w-[350px]">
            <x-forms.label-with-input label="Buyer Name" name="buyerName" type="text" :value="$buyerName" :error="$errors->first('buyerName')"/>
        </div>

        <x-tables.table>
            <table class="min-w-full bg-white shadow-md rounded-lg mt-[20px]" id="table">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="font-medium capitalize text-center w-[150px]">
                            choose
                        </th>
                        <th class="font-medium capitalize">Id Ticket</th>
                        <th class="font-medium capitalize">Shop Name</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
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
                        <tr>
                            <td class="py-3 px-4 w-[150px] text-center">
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
        </x-tables.table>
        <div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-900 rounded-sm duration-300 ease-in-out hover:drop-shadow-[3px_3px_1px_grey] mt-[20px]">Submit</button>
        </div>
    </form>
@endsection
