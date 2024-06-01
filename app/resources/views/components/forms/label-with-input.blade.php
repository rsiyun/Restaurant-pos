<div class="flex flex-col gap-4" x-data="{ focused: false }">
    <label for="{{ $name }}" class="text-sm font-semibold text-gray-600"
        x-bind:class="{ 'text-gray-400': focused }">
        {{ $label }}
    </label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
        x-on:focus="focused = true" x-on:blur="focused = false" {{ $attributes }}>
</div>
