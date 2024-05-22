<!-- Sidebar -->
<div class="flex flex-col justify-between w-64 text-white bg-gray-800">
    {{-- Sidebar Top --}}
    <div class="flex flex-col flex-grow">
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
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard/dev'),
            'title' => 'Dashboard',
        ])
        @include('components.buttons.side-navbar', [
            'url' => '#',
            'title' => 'Kelola Pengguna',
        ])
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard/order'),
            'title' => 'Kelola Toko',
        ])
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard/order'),
            'title' => 'Kelola Order (Pesanan)',
        ])
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard/order'),
            'title' => 'FRONT END COMPONENT',
        ])
    </div>

    {{-- Bottom of the sidebar --}}
    <div class="h-12 border-t border-gray-700">
        <a href="{{ route('logout') }}" class="flex items-center justify-center h-full text-red-500 bg-white">
            Logout
        </a>
    </div>
</div>
