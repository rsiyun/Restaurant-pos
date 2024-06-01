@extends("cpanel.layout.app")

@section("content")
    <h1 class="flex-col mt-6 text-3xl text-blue-600 font-extralight">
        Dashboard
        <h2 class="text-2xl font-bold text-slate-700">
            Order
        </h2>
    </h1>
    <div class="my-2 border-b border-gray-300"></div>
    <div class="flex flex-row justify-start gap-5 pb-5">
        <a href="{{ url('/dashboard/order/create') }}" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Tambah Order
        </a>
    </div>
    <div>
        <table class="w-full text-left border-collapse rounded table-auto">
            <thead>
                <tr>
                    <th
                        class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                        No
                    </th>
                    <th
                        class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                        Id order
                    </th>
                    <th
                        class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                        Nama Pembeli</th>
                    <th
                        class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                        Total</th>
                    <th
                        class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                        Nama Kasir
                    </th>
                    <th
                        class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                        Action
                    </th>


                </tr>
            </thead>
            <tbody>

                @if (isset($data))
                    @foreach ($data["orders"] as $order)
                        <tr class="border border-slate-400">
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
                                {{ $order['kasir']["name"] ?? 'Unknown Status' }}
                            </td>

                            <td id="tableaction" class="w-[5rem] px-4 py-3">
                                <a href="{{ url('/dashboard/order', [$order['slug']]) }}" class="px-4 py-2 text-white bg-green-500 rounded">Detail</a>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="px-4 py-3 text-center">No orders found.</td>
                    </tr>
                @endif
            </tbody>


        </table>
        @if ($data["links"]["last"] != $data["links"]["first"])
        <nav class="flex items-center pt-8 space-x-1">
            <a class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100" href="{{ url('/dashboard/order?page=') }}{{$data['links']['first']}}">
                first
            </a>
            @if ($data["links"]["next"])
            <a href="{{ url('/dashboard/order?page=') }}{{$data['links']['next']}}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">next</a>
            @endif
            @if ($data["links"]["prev"])
            <a href="{{ url('/dashboard/order?page=') }}{{$data['links']['prev']}}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">prev</a>
            @endif

            <a href="{{ url('/dashboard/order?page=') }}{{$data['links']['last']}}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
                last
            </a>
        </nav>
        @endif
    </div>


@endsection
