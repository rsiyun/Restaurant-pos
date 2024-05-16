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

            <div class="flex flex-col justify-center items-center w-[20rem] mt-[4rem] ml-[1rem]">
                <img src="{{ asset('img/logo/Firefly buatkan sebuah logo dari kalimant -ANKEL- buta bertema makanan 91663 1.png') }}"
                    alt="logo-ankel" class="max-w-[5rem]">
                <h3 class="font-bold text-5xl mt-[2rem]">Ankel</h3>
            </div>

            {{-- <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> --}}
            <div class=" mt-[1rem] px-6 py-4 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>

        </div>

        <div class=""> {{-- CHILD IMG COVER --}}
            <img src="{{ asset('img/bg-login/bg-login.png') }}" class="w-[40rem] h-[46rem]" alt="cover-login">
        </div>
    </div>
</body>

</html>
