<div class="flex flex-col pb-4">
    <label for="{{$name}}" class="text-sm pb-2 font-semibold text-gray-600"
    x-bind:class="{ 'text-gray-400': focused }">{{$label}}
    @if (isset($required))
        <span class="text-red-600">*</span>
    @endif
</label>
    <select name="{{$name}}" id="{{$name}}" class="px-4 py-2 border border-gray-300 rounded-sm">
        @foreach ($options as $key => $option)
            <option value="{{$key}}"
            @isset($selected)
                @if ($key == $selected) selected @endif
            @endisset
            >{{$option}}</option>
        @endforeach
    </select>
</div>
