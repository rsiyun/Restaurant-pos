<a href={{ $href ?? '#' }} {{ $attributes ?? '' }}
    class="{{ request()->fullUrlIs(url($href))
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-orange-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-zinc-700 transition duration-150 ease-in-out cursor-pointer'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out cursor-pointer' }}">
    {{ $slot }}
</a>
