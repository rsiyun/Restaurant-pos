@props(['disabled' => false, 'value' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm', 'value'=> $value]) !!} >
