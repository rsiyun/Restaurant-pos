<style>
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    /* Hides the arrows/spinner for Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<div class="flex flex-col pb-4" x-data="{ focused: false }">
    <label for="{{ $name }}" class="text-sm pb-2 font-semibold text-gray-600"
        x-bind:class="{ 'text-gray-400': focused }">
        {{ $label }}
        @if (isset($required))
            <span class="text-red-600">*</span>
        @endif
    </label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="px-4 border border-gray-300 rounded-sm focus:outline-none focus:border-blue-500"
        x-on:focus="focused = true" x-on:blur="focused = false" {{ $attributes }} value="{{$value}}"/>
    @if (isset($error) && $error)
        <span class="text-red-600 text-sm pt-1">
            {{ $error }}
        </span>
    @endif
</div>
