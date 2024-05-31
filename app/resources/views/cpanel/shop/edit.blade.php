@extends('cpanel.layout.app')

@section('content')
    <form action="{{ url('dashboard/shop/' . $slug) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- <div>
            <label for="ownerName">Buyer Name:</label>
            <input type="text" id="ownerName" name="ownerName" required value="{{ $ownerName }}">
        </div>
        <div>
            <label for="shopName">Buyer Name:</label>
            <input type="text" id="shopName" name="shopName" required value="{{ $shopName }}">
        </div> --}}

        <div class="flex flex-col gap-1 mt-[20px]">
            @include('components.input-label', [
                'slot' => 'Owner Name',
            ])

            @include('components.text-input', [
                'value' => $ownerName,
                'name' => "ownerName"
            ])
        </div>

        <div class="flex flex-col gap-1 mt-[20px]">
            @include('components.input-label', [
                'slot' => 'Shop Name',
            ])
            @include('components.text-input', [
                'value' => $shopName ,
                'name' => "shopName"
            ])
        </div>

        <div class="flex flex-col gap-1 mt-[20px]">
            @include('components.input-label', [
                'slot' => 'Role',
            ])
            @include('components.dropdown.dropdown', [
                'title' => '',
                'name' => 'isActive',
                'id' => 'isActive',
                'options' => [
                    '1' => 'isActive',
                    '0' => 'nonActive',
                ],
            ])
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
