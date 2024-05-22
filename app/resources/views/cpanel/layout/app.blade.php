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
    <body>
        <div class="flex h-screen">
            <!-- Sidebar -->
            <div class="w-64 text-white bg-gray-800">
                {{-- Circle Avatar --}}
                <div>
                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="John Doe"
                        class="w-20 h-20 mx-auto my-4 rounded-full">

                    <div class="text-center">
                        <span class="text-2xl font-bold">John Doe</span>
                        <div class="text-sm">Administrator</div>
                    </div>
                </div>

                {{-- Sidebar Links --}}

                <a href="#" class="block px-4 py-2 mt-4 hover:bg-white hover:text-black">Dashboard</a>
                <a href="#" class="block px-4 py-2 mt-4 hover:bg-white hover:text-black">Submenu</a>
                <a href="#" class="block px-4 py-2 mt-4 hover:bg-white hover:text-black">Submenu</a>
                <a href="#" class="block px-4 py-2 mt-4 hover:bg-white hover:text-black">Submenu</a>

                {{-- full width button --}}
                <div class="mt-4">
                    <a href="{{ route('logout') }}" class="px-4 py-2 text-red-500 bg-white border rounded">Logout</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-6">
                Main Content
                <div>
                    @yield("content")
                </div>

            </div>

        </div>
    </body>
</html>

