@extends('cpanel.layout.app')

@section('content')
    <form action="{{ url('dashboard/shop/' . $slug) }}" method="POST">
        @csrf
        @method('PUT')

        <x-forms.label-with-input label="Owner Name" name="ownerName" type="text" :value="$ownerName" :error="$errors->first('ownerName')" required />
        <x-forms.label-with-input label="Shop Name" name="shopName" type="text" :value="$shopName" :error="$errors->first('shopName')" required />

        <div class="flex flex-col gap-1 mt-[20px]">
            <x-forms.input-select
                    :options="['1' => 'isActive', '0' => 'nonActive']"
                    name="isActive"
                    label="isActive"
                    :selected="$isActive"/>
        </div>

        <div class="pt-4">
            <button  class="px-4 py-2 text-white bg-blue-900 duration-300 ease-in-out rounded-sm hover:drop-shadow-[3px_3px_1px_grey]" type="submit">Submit</button>
        </div>
    </form>
@endsection
