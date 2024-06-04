@extends('cpanel.layout.app')

@section('content')
    {{-- Judul Section --}}
    @include('components.texts.h1-dashboard', ['title' => 'Overview', 'subtitle' => 'Dashboard'])

    {{-- border separator --}}
    <div class="my-2 border-b border-gray-300"></div>

    {{-- Card untuk informasi user --}}
    <div class="grid grid-cols-3 gap-3 ">

        <div id="userCard"
            class="min-h-[4rem]
        min-w-[10rem]
        p-4 flex flex-col bg-white border-2 shadow-sm rounded-2xl justify-around">
            Jumlah Pengguna:
            <span class="text-2xl font-bold text-blue-600">
                @if ($listUser)
                    {{ count($listUser) }}
                @else
                    Unknown
                @endif
            </span>
        </div>

        <div id="shopCard"
            class="min-h-[4rem]
        min-w-[10rem]
        p-4 flex flex-col bg-white border-2 shadow-sm rounded-2xl">
            Jumlah Toko:
            <span class="text-2xl font-bold text-blue-600">
                {{-- {{ $shops ?? 'Unknown' }} --}}

                @if ($listShop)
                    {{ count($listShop) }}
                @else
                    Unknown
                @endif
            </span>
        </div>

        <div id="userCard"
            class="min-h-[4rem]
        min-w-[10rem]
        p-4 flex flex-col bg-white border-2 shadow-sm rounded-2xl">
            Jumlah Order:
            <span class="text-2xl font-bold text-blue-600">
                {{-- {{ $users ?? 'Unknown' }} --}}

                @if ($listOrder)
                    {{ count($listOrder) }}
                @else
                    Unknown
                @endif
            </span>
        </div>

        <div id="userCard"
            class="min-h-[4rem]
        min-w-[10rem]
        p-4 flex flex-col bg-white border-2 shadow-sm rounded-2xl justify-around">
            Jumlah Ticket:
            <span class="text-2xl font-bold text-blue-600">
                @if ($listTicket)
                    {{ count($listTicket) }}
                @else
                    Unknown
                @endif
            </span>
        </div>
    </div>
@endsection
