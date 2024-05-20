@extends('layouts.app')


@section('slot')
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
                Hello, {{ Auth::user()->name ?? 'Admin' }}
            </div>

        </div>

    </div>
@endsection
