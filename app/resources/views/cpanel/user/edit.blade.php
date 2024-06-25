@extends('cpanel.layout.app')
@section('content')
    <div class="item-center place-item-center border border-black rounded-[5px] px-5 pt-5 mt-[50px]">
        <form method="POST" action="{{ url('dashboard/user/' . $user['slug']) }}">
            @csrf
            @method('PUT')

            <x-forms.label-with-input label="Username" name="name" type="text" :value="$user['name']" :error="$errors->first('name')" />
            <x-forms.label-with-input label="Email" name="email" type="text" :value="$user['email']" :error="$errors->first('email')" />
            <x-forms.label-with-input label="Password" name="password" type="text" :value="''" />

            <div class="flex flex-col gap-1 mt-[20px]">
                <x-forms.input-select :selected="$user['role']" required :options="['Admin' => 'Admin', 'Kasir' => 'Kasir', 'ShopEmployee' => 'ShopEmployee']" name="role" label="Role" />
            </div>

            <div class="flex flex-col gap-1 mt-[20px]">
                <x-forms.input-select :selected="$user['isActive']" :options="['0' => 'Non Active', '1' => 'Active']" name="isActive" label="Status" required />
            </div>

            @if ($user['role'] == 'ShopEmployee')
                <div class="flex flex-col gap-1 mt-[20px]">
                    <x-forms.input-select :selected="$user['idShop']" :options="$shopList" name="idShop" label="Nama Shop" />
                </div>
            @endif

            <div class="py-8">
                <button type="submit" class="px-4 py-2 text-white bg-blue-900 rounded-sm duration-300 ease-in-out hover:drop-shadow-[3px_3px_1px_grey]">
                    Edit User
                </button>
            </div>
        </form>




    </div>
@endsection
