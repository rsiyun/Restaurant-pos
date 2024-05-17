<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Email Address -->
        <div class="ml-[6rem]">
            <x-input-label for="email" class="text-l" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-[19rem] h-[2rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4 ml-[6rem]">
            <x-input-label for="name" class="text-l" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-[19rem] h-[2rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 ml-[6rem]">
            <x-input-label for="password" class="text-l" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-[19rem] h-[2rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 ml-[6rem]">
            <x-input-label for="password_confirmation" class="text-l" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-[19rem] h-[2rem] bg-white-700 rounded-none drop-shadow-[3px_3px_1px_grey] border-[1px] border-black"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="block mt-4 ml-[6rem] flex justify-between h-[2rem]">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-xl focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">
                    I agree to ANKJEL <span class="text-sky-500"><a href="">{{ __('Privacy Policy')}}</a></span>
                </span>
                {{-- <span class="ms-2 text-sm text-gray-600">{{ __('I agree to ANKJEL Terms of Use and have read and acknowledged Privacy Policy') }}</span> --}}
            </label>
        </div>

        <div class="flex flex-col items-center justify-end mt-4">
            <x-primary-button class="rounded-sm pl-3 border w-[25rem] h-[2.7rem] mt-4 bg-blue-950 duration-300 ease-in-out hover:drop-shadow-[3px_3px_1px_grey] border">
                <p class="flex justify-center w-full normal-case text-l">
                    <span>
                        {{ __('Register') }}
                    </span>
                </p>
            </x-primary-button>

            <span class="mt-[1rem]">
                Have Account?
                <span>
                    <a class="text-sm text-red-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Login Now') }}
                    </a>
                </span>
            </span>
        </div>
    </form>
</x-guest-layout>
