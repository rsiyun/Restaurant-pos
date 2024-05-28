<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    {{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 border-[10px] border-red-700"> --}}

    <div class="flex justify-between">{{-- PARENT LOGIN --}}

        <div class="flex flex-col w-[38rem]">{{-- CHILD FORM --}}

            {{-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> --}}

            <div class="flex flex-col justify-center items-center w-[20rem] mt-[4rem]">
                <a href="/">
                    <img src="{{ asset('img/logo/Firefly buatkan sebuah logo dari kalimant -ANKEL- buta bertema makanan 91663 1.png') }}"
                    alt="logo-ankel" class="max-w-[4rem]">
                </a>
                <h3 class="font-bold text-3xl mt-[2rem]">Ankel</h3>
            </div>

            {{-- <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> --}}
            <div class=" mt-[1rem] px-6 py-4 overflow-hidden sm:rounded-lg">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- <div class="h-[20rem] border border-red-700"></div> --}}

                    <!-- Email Address -->
                    <div class="ml-[6rem]">
                        <x-input-label for="email" class="text-xl" :value="__('Email')" />
                        {{-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" /> --}}
                        <x-text-input id="email" class="block mt-1 w-[23rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Input your Password" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4 ml-[6rem]">
                        <x-input-label class="text-xl" for="password" :value="__('Password')" />

                        {{-- <x-text-input id="password" class="block mt-1 w-full" --}}
                        <x-text-input id="password" class="block mt-1 w-[23rem] rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password"
                                        placeholder="Input your Password"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- <div class="flex items-center justify-end mt-4"> --}}
                    <div class="mt-5 ml-[5rem] flex items-center justify-center">
                        {{-- @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif --}}

                        {{-- <x-primary-button class="ms-3"> --}}
                        <x-primary-button class="rounded-sm pl-3 border w-full h-[2.7rem] mt-4 bg-blue-950 duration-300 ease-in-out hover:drop-shadow-[3px_3px_1px_grey] border">
                            <p class="flex justify-center w-full normal-case text-xl">
                                <span>
                                    {{ __('Login') }}
                                </span>
                            </p>

                        </x-primary-button>
                    </div>

                    <div class="mt-2 ml-[4rem] w-[31rem] flex items-center justify-center">
                        <p>Don't Have account? <span class="text-red-600 duration-300 ease-in-out hover:underline"><a href="/register">Register</a></span></p>
                    </div>
                </form>
            </div>

        </div>

        <div class=""> {{-- CHILD IMG COVER --}}
            <img src="{{ asset('img/bg-login/bg-login.png') }}" class="w-[40rem] h-[46rem]" alt="cover-login">
        </div>
    </div>
</body>

</html>
