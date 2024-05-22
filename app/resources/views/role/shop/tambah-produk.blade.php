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
