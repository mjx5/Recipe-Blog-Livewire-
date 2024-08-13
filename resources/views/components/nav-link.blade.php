@props(['href', 'isActive' => false, 'text'])

<a  wire:navigate href="{{ $href }}"
   class="{{ $isActive ? 'text-gray-800 dark:text-blue-500 bg-gray-50 focus:ring-4 focus:ring-gray-300' : 'text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}
            font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none
            active:bg-blue-500 active:text-blue-300 dark:active:bg-blue-700 dark:active:text-gray-100">
   {{ $text }}
</a>
