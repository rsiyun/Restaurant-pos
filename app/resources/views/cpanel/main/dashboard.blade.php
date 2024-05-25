@extends('cpanel.layout.app')

@section('content')
    {{-- @include('components.receipts.receipts', [
        'type' => 'success',
        'message' => 'This is a success message',
    ]) --}}

    {{-- @include('components.receipts.receipts', [
        'type' => 'failed',
        'message' => 'This is a failed message',
    ]) --}}

    <div class="pb-8">
        <h2 class="text-2xl font-bold text-right text-blue-600">
            Hai, {{ $profile["name"] ?? 'Developer' }}!
        </h2>
    </div>

    {{-- Judul Section --}}
    <h1 class="mt-6 text-3xl font-bold text-blue-600">
        Statistik Bisnis
    </h1>

    {{-- border separator --}}
    <div class="my-4 border-b border-gray-300"></div>

    {{-- Card untuk informasi user --}}
    <div class="grid grid-cols-3 space-x-5">

        <div id="userCard"
            class="min-h-[4rem]
        min-w-[10rem]
        p-4 flex flex-col bg-white border-2 shadow-sm rounded-2xl justify-around">
            Jumlah Pengguna:
            <span class="text-2xl font-bold text-blue-600">
                @if ($listUser)
                    {{ count($listUser['users']) }}
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
                {{ $shops ?? 'Unknown' }}
            </span>
        </div>

        <div id="userCard"
            class="min-h-[4rem]
        min-w-[10rem]
        p-4 flex flex-col bg-white border-2 shadow-sm rounded-2xl">
            Jumlah Order:
            <span class="text-2xl font-bold text-blue-600">
                {{ $users ?? 'Unknown' }}
            </span>
        </div>
    </div>
@endsection
