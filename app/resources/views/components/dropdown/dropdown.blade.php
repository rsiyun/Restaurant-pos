<!-- components/dropdown/dropdown.blade.php -->
@props([
    'title',
    'name',
    'id',
    'options',
    'disabled' => false,
])

<div class="flex flex-col gap-4">
    <select {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
        @foreach ($options as $key => $option)
            <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
