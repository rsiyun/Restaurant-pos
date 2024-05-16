<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- <div class="h-[20rem] border border-red-700"></div> --}}

        <!-- Email Address -->
        <div class="ml-[6rem]">
            <x-input-label for="email" class="text-xl" :value="__('Email')" />
            {{-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" /> --}}
            <x-text-input id="email" class="block mt-1 w-[23rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 ml-[6rem]">
            <x-input-label class="text-xl" for="password" :value="__('Password')" />

            {{-- <x-text-input id="password" class="block mt-1 w-full" --}}
            <x-text-input id="password" class="block mt-1 w-[23rem] rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 ml-[6rem] flex justify-between w-[23rem]">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-xl focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        {{-- <div class="flex items-center justify-end mt-4"> --}}
        <div class="mt-5 ml-[5rem] flex items-center justify-center">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

            {{-- <x-primary-button class="ms-3"> --}}
            <x-primary-button class="rounded-sm pl-3 border w-full h-[2.7rem] mt-4 bg-blue-950 duration-300 ease-in-out hover:bg-blue-950 hover:drop-shadow-[3px_3px_1px_grey] border">
                <p class="flex justify-center w-full">
                    <span>
                        {{ __('Login') }}
                    </span>
                </p>

            </x-primary-button>
        </div>

        <div class="mt-2 ml-[4rem] w-[31rem] flex items-center justify-center">
            <p>Don't Have account? <span class="text-red-600 duration-300 ease-in-out hover:text-slate-400"><a href="">Register</a></span></p>
        </div>
    </form>
</x-guest-layout>
