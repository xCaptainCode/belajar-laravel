@props(['active' => false])

<a {{ $attributes }} aria-current="{{ $active ? 'page' : false }}"
    class="{{ $active ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} 
    rounded-md px-3 py-2 text-sm font-medium text-white">{{ $slot }}</a>