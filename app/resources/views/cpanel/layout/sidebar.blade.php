<!-- Sidebar -->
<div class="flex flex-col justify-between w-64 h-screen text-white bg-blue-900">
    {{-- Sidebar Top --}}
    <div class="flex flex-col flex-grow">
        {{-- Circle Avatar --}}
        <div class="pt-2 pb-4 border-b ">
            <img src="https://ui-avatars.com/api/?name={{ $profile['name'] ?? 'Developer Mode' }}&background=random"
                alt="{{ $profile['name'] ?? 'Developer Mode' }}" class="w-20 h-20 mx-auto my-4 rounded-full">
            <div class="tracking-widest text-center">
                {{-- add text spacing --}}
                <span class="text-2xl font-light">
                    {{ $profile['name'] ?? 'Developer Mode' }}
                </span>

                {{-- Jabatan disini ya ges --}}
                <div class="text-sm font-bold">
                    ~ {{ $profile['role'] ?? 'Administrator' }} ~
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
    </div>

    {{-- Bottom of the sidebar --}}
    <div class="h-12 mb-5 ml-4 border-gray-700">
        <form
            class="flex items-end justify-start h-full font-bold "action="{{ route('logout') }}"
            method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 text-blue-700 transition bg-white rounded-md hover:text-white hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>
    <footer class="w-full p-2 text-center text-white bg-blue-900">
        <div class="flex items-center justify-center h-full">
            <span class="text-sm">
                {{ now()->format('Y') }} - &copy;
                <span class="font-bold">
                    Tim Penjual Organ Balita
                </span>
            </span>
        </div>
    </footer>
</div>
