@extends('cpanel.layout.app')

@section('content')
    <h1 class="flex-col mt-6 text-3xl text-blue-600 font-extralight">
        Dashboard
        <h2 class="text-2xl font-bold text-slate-700">
            Order
        </h2>
    </h1>
    <div class="my-2 border-b border-gray-300"></div>
    <div class="flex flex-row justify-start gap-5 pb-5">
        <a href="{{ url('/dashboard/order/create') }}" class="px-4 py-2 mt-2 text-white bg-blue-900 duration-300 ease-in-out rounded-sm hover:drop-shadow-[3px_3px_1px_grey]">
            Tambah Order
        </a>
    </div>
    <div>
        <x-tables.table>
            <table id="table" class="w-full text-left">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="font-medium capitalize">
                            No
                        </th>
                        <th class="font-medium capitalize">
                            Id order
                        </th>
                        <th class="font-medium capitalize">
                            Nama Pembeli</th>
                        <th class="font-medium capitalize">
                            Total</th>
                        <th class="font-medium capitalize">
                            Nama Kasir
                        </th>
                        <th class="font-medium capitalize">
                            Action
                        </th>


                    </tr>
                </thead>
                <tbody class="bg-white">
                        @foreach ($data as $order)
                            <tr>
                                <td class="px-4 py-3">
                                    {{ $loop->iteration ?? 0 }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $order['slug'] ?? 'Unknown Status' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $order['buyerName'] ?? 'Unknown Status' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $order['totalOrder'] ?? 'Unknown Status' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $order['kasir']['name'] ?? 'Unknown Status' }}
                                </td>

                                <td class="px-4 py-3">
                                    <div class="p-1 flex justify-center">
                                        <a href="{{ url('/dashboard/order', [$order['slug']]) }}"
                                        class="px-4 py-2 text-white bg-green-500 rounded-sm">Detail</a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                </tbody>


            </table>
        </x-tables.table>

    </div>


@endsection
