<div class="flex items-center justify-center h-30rem mt-4 rounded-xl {{ isset($bg) ? 'bg-' . $bg : 'bg-gray-200' }}">
    <h1 class="text-5xl font-bold {{ isset($textColor) ? 'text-' . $textColor : 'text-white' }}">
        {{ $slot ?? 'No Hero Title' }}
    </h1>
</div>
