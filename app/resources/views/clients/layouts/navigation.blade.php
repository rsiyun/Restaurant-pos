<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex items-center shrink-0">
                    <a href="#">
                        <img src="{{ asset('img/logo/Firefly buatkan sebuah logo dari kalimant -ANKEL- buta bertema makanan 91663 1.png') }}"
                            class="max-w-[3rem] max-h-[3rem] " alt="..." style="height: 18rem">
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @include('components.nav-link', [
                        'href' => '/',
                        'slot' => 'Product',
                    ])
                    @include('components.nav-link', [
                        'href' => '/ticket',
                        'slot' => 'Tickets',
                    ])
                </div>
            </div>

            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        @include('components.nav-link', [
                            'href' => '/cart',
                            'slot' => 'Cart',
                            'svg' => 'img/logo/cart.svg',
                        ])

                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="h-16 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out cursor-pointer">
                                <div>{{ $profile['name'] ?? 'Akun' }}</div>

                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                        </x-slot>

                        <x-slot name='content'>
                            @if (session()->has('user'))
                                {{-- <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link> --}}

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @else
                                <x-dropdown-link :href="route('login')">
                                    {{ __('Login') }}
                                </x-dropdown-link>
                            @endif
                        </x-slot>


                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="flex items-center -me-2 sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <!-- Responsive Settings Options -->
            <div class="px-4 pt-4 pb-1 border-t border-gray-200">
                <div class="text-base font-medium text-gray-800">
                    {{ $profile['name'] ?? 'Guest' }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                    {{ $profile['role'] ?? 'Guest' }}
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>

            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="url('/')">
                    {{ __('Order') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/')">
                    {{ __('Riwayat') }}
                </x-responsive-nav-link>
            </div>
        </div>
</nav>
