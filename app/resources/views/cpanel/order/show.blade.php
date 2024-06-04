@extends('cpanel.layout.app')
@section('content')
    <div class="flex justify-end">
        <div class="flex gap-4">
            <a
                href="{{ url('/dashboard/order') }}{{ '/' . $data['slug'] . '/edit' }}"class="px-4 py-2 bg-blue-500 rounded text-white">update</a>
            <form action="{{ url('/dashboard/order/' . $data['slug']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 rounded text-white"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
            </form>
        </div>
    </div>

    <div class="p-6 text-black rounded-lg shadow-lg bg-white w-[52rem]">
        <div class="flex flex-col items-end justify-end gap-5">
            {{-- From --}}
            <div class="flex justify-center space-x-10">
                {{-- Title --}}
                <div class="inline-flex flex-col items-end justify-end text-right">
                    <div class="text-sm font-bold">
                        From:
                        <div class="text-md">
                            {{ $data['kasir']['name'] }}
                        </div>
                    </div>
                </div>
                <div class="inline-flex flex-col items-end justify-end text-right">
                    <div class="text-sm font-bold">
                        To:
                        <div class="text-md">
                            {{ $data['buyerName'] }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row for title and idStruk --}}
            <div class="flex items-center justify-between w-full">
                <div class="text-[2.5rem] font-bold text-black">
                    {{ $data['tickets'][0]['shop']['shopName'] }}
                </div>
                <div class="text-2xl font-bold text-gray-500">
                    #{{ $data['idOrder'] }}
                </div>
            </div>

            {{-- Issued Date --}}
            <div class="inline-flex space-x-20 w-[30rem]">
                <div class="w-full font-bold text-right">
                    Issued
                    <div class="font-normal">
                        {{ date('l, Y-m-d', strtotime($data['tickets'][0]['created_at'])) }}
                    </div>
                </div>
                <div class="w-full font-bold text-right">
                    Updated
                    <div class="font-normal">
                        {{ date('l, Y-m-d', strtotime($data['tickets'][0]['updated_at'])) }}
                    </div>
                </div>
            </div>

            {{-- Item Details --}}
            <div class="w-full pt-4 border-t border-gray-200">
                <div class="text-lg font-bold">
                    Item Details
                </div>
                @foreach ($data['tickets'][0]['ticketDetail'] as $detail)
                    <div class="flex justify-between">
                        <div class="text-md">
                            {{ $detail['product']['productName'] }} ({{ $detail['quantity'] }}):
                        </div>
                        <div class="text-md">
                            Rp. {{ number_format($detail['priceTicketDetail'], 2, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Payment Details --}}
            <div class="w-full pt-4 border-t border-gray-200">
                <div class="text-lg font-bold">
                    Payment Details
                </div>
                <div class="flex justify-between">
                    <div class="text-md">
                        Subtotal:
                    </div>
                    <div class="text-md">
                        Rp. {{ number_format($data['tickets'][0]['priceTickets'], 2, ',', '.') }}
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="text-md">
                        Tax (10%):
                    </div>
                    <div class="text-md">
                        Rp. {{ number_format($data['tickets'][0]['priceTickets'] * 0.1, 2, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="w-full pt-4 border-t border-gray-200">
                <div class="flex flex-col items-end justify-end font-bold">
                    <div class="text-md">
                        Total Amount:
                    </div>
                    <div class="text-[3rem]">
                        <span class="text-2xl text-gray-500">
                            Rp.
                        </span>
                        {{ number_format($data['tickets'][0]['priceTickets'] * 1.1, 2, ',', '.') }}
                    </div>
                </div>
                <div class="text-lg font-bold">
                    Additional Information
                </div>
                <div class="text-md">
                    Thank you for your purchase! If you have any questions, please contact us at support@example.com.
                </div>
            </div>
        </div>
    </div>
@endsection
