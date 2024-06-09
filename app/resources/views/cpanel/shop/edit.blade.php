@extends('cpanel.layout.app')

@section('content')
    <form action="{{ url('dashboard/shop/' . $slug) }}" method="POST">
        @csrf
        @method('PUT')

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
            <x-forms.input-select
                    :options="['1' => 'isActive', '0' => 'nonActive']"
                    name="isActive"
                    label="isActive"
                    :selected="$isActive"/>
        </div>

        <div class="pt-4">
            <button  class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700" type="submit">Submit</button>
        </div>
    </form>
@endsection
