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
    @stack("styles")
</head>
<body class="flex flex-col min-h-screen">
    <div class="flex flex-1">
        <div class="sticky top-0 w-64 h-screen text-white bg-blue-900 shadow-lg">
            @include('cpanel.layout.sidebar')
        </div>
        <!-- Main Content -->
        <div class="flex flex-col flex-1">
            <div class="flex-1 p-6 overflow-y-auto bg-slate-100">
                <div class="pb-8">
                    <h2 class="text-2xl font-bold text-right text-blue-600">
                        Hai, {{ $profile["name"] ?? 'Developer' }}!
                    </h2>
                </div>
                @yield('content')
            </div>
        </div>

    </div>
</body>
@stack("scripts")
</html>
