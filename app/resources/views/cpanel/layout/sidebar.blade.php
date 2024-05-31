<!-- Sidebar -->
<div class="flex flex-col justify-between w-64 h-screen text-white bg-blue-900">
    {{-- Sidebar Top --}}
    <div class="flex flex-col flex-grow">
        {{-- Circle Avatar --}}
        <div class="border-b">
            <img src="https://ui-avatars.com/api/?name={{ $profile['name'] ?? 'Developer Mode' }}&background=random"
                alt="{{ $profile['name'] ?? 'Developer Mode' }}"
                class="w-20 h-20 mx-auto my-4 rounded-full">
            <div class="text-center">
                <span class="text-2xl font-bold">
                    {{ $profile['name'] ?? 'Developer Mode' }}
                </span>
                <div class="text-sm">
                    {{ $profile['role'] ?? 'Administrator' }}
                </div>
            </div>
        </div>
        {{-- Sidebar Links --}}
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard'),
            'title' => 'Dashboard',
        ])
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard/user'),
            'title' => 'Kelola Pengguna',
        ])
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard/shop'),
            'title' => 'Kelola Toko',
        ])
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard/order'),
            'title' => 'Kelola Order (Pesanan)',
        ])
        @include('components.buttons.side-navbar', [
            'url' => url('/dashboard/components'),
            'title' => 'FRONT END COMPONENT',
        ])
    </div>

    {{-- Bottom of the sidebar --}}
    <div class="h-12 border-t border-gray-700">
        <form
            class="flex items-center justify-center h-full font-bold text-red-500 transition bg-white hover:text-white hover:bg-red-500"action="{{ route('logout') }}"
            method="POST">
            @csrf
            <button type="submit">
                Logout
            </button>
        </form>
    </div>
</div>
