@extends('clients.layouts.app')

@section('slot')
<div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh] pt-8">
    <div class="max-w-4xl mx-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            idTicket
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order Note
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">view</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data["tickets"] as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item["slug"]}}
                            </th>
                            <td class="px-6 py-4">
                                {{$item["orderNote"]}}
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{$item["priceTickets"]}}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-modal.modal-ticket />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
