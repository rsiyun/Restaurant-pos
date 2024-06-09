@extends('clients.layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh] pt-8">
        <div class="max-w-4xl mx-auto">
            <x-tables.table>
                <div class="w-full mx-auto p-4 rounded-md">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500" id="table">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                                    status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">view</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item['slug'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item['orderNote'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp. {{ $item['priceTickets'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item['idOrder'] == null ? 'Belum Terbayar' : 'Terbayar' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <x-modal.modal-ticket :datas="json_encode($item, JSON_FORCE_OBJECT)" />
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </x-tables.table>
        </div>
    </div>
@endsection
