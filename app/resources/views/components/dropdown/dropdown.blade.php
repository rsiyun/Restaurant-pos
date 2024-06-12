<!-- components/dropdown/dropdown.blade.php -->
@props([
    'title',
    'name',
    'id',
    'options',
    'disabled' => false,
    // 'width' => 'w-48'
])

<div class="flex flex-col gap-4 ">
    <select {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" name="{{ $name }}"  class="rounded-sm shadow-sm cursor-pointer focus:border-blue-500 focus:ring-blue-500">
        @foreach ($options as $key => $option)
            <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
