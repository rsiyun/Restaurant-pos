@extends('cpanel.layout.app')
@section('content')
    <div class="pb-8">
        <h2 class="text-2xl font-bold text-right text-blue-600">
            Hai, {{ $profile['name'] ?? 'Developer' }}!
        </h2>
    </div>

    <div class="item-center place-item-center border border-black rounded-[5px] px-5 mt-[50px]">
        <form method="POST" action="{{ url('dashboard/user/' . $user['slug']) }}">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-1 mt-[20px]">
                @include('components.input-label', [
                    'slot' => 'Username',
                ])
                @include('components.text-input', [
                    'value' => $user['name'],
                    'name' => 'name',
                ])
            </div>

            <div class="flex flex-col gap-1 mt-[20px]">
                @include('components.input-label', [
                    'slot' => 'Email',
                ])
                @include('components.text-input', [
                    'value' => $user['email'],
                    'name' => 'email',
                ])
            </div>

            <div class="flex flex-col gap-1 mt-[20px]">
                @include('components.input-label', [
                    'slot' => 'Password',
                ])
                @include('components.text-input', [
                    'value' => $user['password'] ?? '',
                    'name' => 'password',
                ])
            </div>

            <div class="flex flex-col gap-1 mt-[20px]">
                @include('components.input-label', [
                    'slot' => 'Role',
                ])
                <!-- Your Blade template -->
                @include('components.dropdown.dropdown', [
                    'title' => '',
                    'name' => 'role',
                    'id' => 'role',
                    'options' => $profile ?? [
                        'Admin' => 'Admin',
                        'Kasir' => 'Kasir',
                        'ShopEmployee' => 'ShopEmployee',
                    ],
                ])
            </div>

            <div class="flex flex-col gap-1 mt-[20px]">
                @include('components.input-label', [
                    'slot' => 'Status',
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

            @if ($user['role'] == 'ShopEmployee')
                <div class="flex flex-col gap-1 mt-[20px]">
                    @include('components.input-label', [
                        'slot' => 'idshop',
                    ])

                    {{-- fetch all shop list name --}}
                    @include('components.dropdown.dropdown', [
                        'title' => '',
                        'name' => 'idshop',
                        'id' => 'idshop',
                        'options' => $shopList ?? [
                            'Admin' => 'Admin',
                            'Kasir' => 'Kasir',
                            'ShopEmployee' => 'ShopEmployee',
                        ],
                    ])
                </div>
            @endif

            <div class="py-8">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Edit User
                </button>
            </div>
        </form>




    </div>
@endsection
