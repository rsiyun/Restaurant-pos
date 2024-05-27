@extends('cpanel.layout.app')
@section('content')
    <div class="pb-8">
        <h2 class="text-2xl font-bold text-right text-blue-600">
            Hai, {{ $profile['name'] ?? 'Developer' }}!
        </h2>
    </div>

    <div class="item-center place-item-center border border-black h-[30rem] rounded-[5px] px-5 mt-[50px]">
        @csrf
        <form method="{{ url('') }}">
            <div class="flex flex-col gap-1 mt-[20px]">
                @include('components.input-label', [
                    'slot' => 'Username',
                ])

                @include('components.text-input', [
                    'value' => $profile['name'],
                ])
            </div>

            <div class="flex flex-col gap-1 mt-[20px]">
                @include('components.input-label', [
                    'slot' => 'Email',
                ])
                @include('components.text-input', [
                    'value' => $profile['email'],
                ])
            </div>

            <div class="flex flex-col gap-1 mt-[20px]">
                @include('components.input-label', [
                    'slot' => 'Password',
                ])
                @include('components.text-input', [
                    'value' => '',
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
                    'options' => [
                        'admin' => 'Admin',
                        'user' => 'User',
                        'shopEmployee' => 'Shop Employee',
                    ],
                ])
            </div>

            <div class="flex flex-col gap-1 mt-[20px] w-fit">
                @include('components.buttons.button', [
                    'label' => 'Update',
                    'buttonTitle' => 'Update User',
                ])
            </div>
        </form>




    </div>
@endsection
