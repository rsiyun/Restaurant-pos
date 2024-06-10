@extends('cpanel.layout.app')
@section('content')
    <div class="flex justify-end">
        <div class="flex gap-4">
            <a
                href="{{ url('/dashboard/user') }}{{ '/' . $user['slug'] . '/edit' }}"class="px-4 py-2 bg-blue-500 rounded text-white">update</a>
        </div>
    </div>

    <div class="pb-4">
        <div class="w-[300px] mt-[-90px] pl-[10px] pt-[10px] space-y-1 rounded bg-white shadow-md">
            <div class="py-2 px-2">
                <p class="pb-2"><strong>Id User:</strong> {{ $user['slug'] }}</p>
                <p class="pb-2"><strong>Name:</strong> {{ $user['name'] }}</p>
                <p class="pb-2"><strong>Role:</strong> {{ $user['role'] }}</p>
                <p class="pb-2"><strong>Email:</strong> {{ $user['email'] }}</p>
                @if ($user['isActive'])
                    <p><strong>Status:</strong> active</p>
                @else
                    <p><strong>Status:</strong> Non active</p>
                @endif

                @if (isset($shopList))
                    <br>
                    <p class="pb-2"><strong>Nama Toko:</strong> {{ $shopList['shopName'] }}</p>
                    <p class="pb-2"><strong>Nama Pemilik:</strong> {{ $shopList['ownerName'] }}</p>
                    <p class="pb-2"><strong>Status Toko:</strong>
                        {{ $shopList['isActive'] ? 'Active' : 'Non Active' }}</p>
                @endif
            </div>
        </div>
    @endsection
