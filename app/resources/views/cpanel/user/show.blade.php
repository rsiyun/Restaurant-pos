@extends('cpanel.layout.app')
@section('content')
    <div class="flex justify-end">
        <div class="flex gap-4">
            <a
                href="{{ url('/dashboard/user') }}{{ '/' . $data['slug'] . '/edit' }}"class="px-4 py-2 bg-blue-500 rounded text-white">update</a>
        </div>
    </div>

    <div class="pb-4"></div>
    <div class="w-[300px] mt-[-90px] pl-[10px] pt-[10px] space-y-1 rounded bg-white shadow-md">
        <div class="py-2 px-2">
            <p class="pb-2"><strong>Id User:</strong> {{ $data['slug'] }}</p>
            <p class="pb-2"><strong>Name:</strong> {{ $data['name'] }}</p>
            <p class="pb-2"><strong>Email:</strong> {{ $data['email'] }}</p>
            @if ($data['isActive'])
                <p><strong>Status:</strong> active</p>
            @else
                <p><strong>Status:</strong> Non active</p>
            @endif
        </div>
    </div>
    </div>
@endsection
