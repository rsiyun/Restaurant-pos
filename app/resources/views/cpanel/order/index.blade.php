@extends("cpanel.layout.app")
@section("content")
<div class="container mx-auto">
    <div class="flex justify-end pb-6">
        <a href="{{ url('/dashboard/order/create') }}"class="px-4 py-2 bg-green-500 rounded text-white">create</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Slug</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Buyer Name</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Total Order</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">Nama Kasir</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data["orders"] as $order)
                <tr class="bg-gray-100 border-b text-center">
                    <td class="py-3 px-4">{{ $order['slug'] }}</td>
                    <td class="py-3 px-4">{{ $order['buyerName'] }}</td>
                    <td class="py-3 px-4">{{ $order['totalOrder'] }}</td>
                    <td class="py-3 px-4">{{ $order['kasir']["name"] }}</td>
                    <td class="py-3 px-4">
                        <a href="{{ url('/dashboard/order', [$order['slug']]) }}" class="px-4 py-2 bg-green-500 rounded text-white">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($data["links"]["last"] != $data["links"]["first"])
        <nav class="flex items-center space-x-1 pt-8">
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
</div>


@endsection
