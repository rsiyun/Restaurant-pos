<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center">

            <div class="border border-black mt-[2rem] mb-[2rem] h-[83vh] w-[73rem] flex flex-col items-center">
                {{-- OUTER --}}
                <form action="">
                    <div
                        class="flex flex-col justify-center items-center mt-[1.5rem] h-[17rem] w-[35rem] bg-gray-200 rounded-sm shadow-[2px_2px_7px_-1px_grey] border border-black border-dashed">

                        <span class="flex flex-col items-center">
                            <div class=" max-w-[5rem] max-h-[5rem]">
                                <img src="{{ asset('img/logo/imgUpload.png') }}" alt="">
                            </div>
                            <h1 class="text-xl font-bold mt-3 text-white">Select an image file to upload</h1>
                            <h3 class="text-white">or drag and drop your item</h3>
                        </span>
                        {{-- <h1 class="text-lg font-bold flex items-center">Upload Image Here</h1> --}}
                        <input type="file" class="opacity-0 cursor-pointer">
                    </div>

                    {{-- FORM --}}
                    <div class="">
                        <x-text-input id="new-foot"
                            class="pl-[2rem] rounded-sm block mt-1 w-[35rem] mt-[1rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black"
                            type="text" name="foot" placeholder="Enter the name of the food" />

                        <x-text-input id="new-foot"
                            class="pl-[2rem] rounded-sm block mt-1 w-[35rem] mt-[1rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black"
                            type="text" name="foot" placeholder="Enter the price" />

                        <x-text-input id="new-foot"
                            class="pl-[2rem] rounded-sm block mt-1 w-[35rem] mt-[1rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black"
                            type="text" name="foot" placeholder="Enter stock" />

                        {{-- <x-text-input id="new-foot"
                            class="pl-[2rem] rounded-sm block mt-1 w-[35rem] mt-[1rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black"
                            type="text" name="foot" placeholder="Type" /> --}}

                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="border inline-flex items-center mt-[1rem] w-[35rem] px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-black rounded-md hover:text-gray-700 focus:outline-none">
                                        Type
                                        <div class="ms-1">
                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                            <x-slot name='content'>
                                @auth
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

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

                                    @if (Route::has('register'))
                                        <x-dropdown-link :href="route('register')">
                                            {{ __('Register') }}
                                        </x-dropdown-link>
                                    @endif
                                @endauth
                            </x-slot>
                        </x-dropdown>

                    </div>

                    <div class="flex justify-center mt-2">
                        <x-primary-button
                            class="rounded-sm pl-3 border w-[9rem] h-[2rem] mt-4 bg-blue-950 duration-300 ease-in-out hover:drop-shadow-[3px_3px_1px_grey] border">
                            <p class="flex justify-center w-full normal-case text-l">
                                <span>
                                    {{ __('Upload') }}
                                </span>
                            </p>
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>
