<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>

        <div class="inline-grid grid-cols-3 gap-12">
            @include('components.cards.cards-2', ['name' => 'Card 1', 'content' => 'Content 1'])
            @include('components.cards.cards-2', ['name' => 'Card 1', 'content' => 'Content 1'])
            @include('components.cards.cards-2', ['name' => 'Card 1', 'content' => 'Content 1'])
            @include('components.cards.cards-2', ['name' => 'Card 1', 'content' => 'Content 1'])
            @include('components.cards.cards-2', ['name' => 'Card 1', 'content' => 'Content 1'])
            @include('components.cards.cards-1', ['name' => 'Card 2', 'content' => 'Content 2'])
        </div>


    </x-slot>
</x-app-layout>
