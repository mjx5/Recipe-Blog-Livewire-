@if (session()->has('update_error'))
    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
        <p class="font-bold">Error!</p>
        <p>{{ session('update_error') }}</p>
    </div>
@endif

@if (session()->has('logout-error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Error!</span> {{ session('logout_error') }}
    </div>
@endif

@if (session()->has('delete_error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Error!</span> {{ session('delete_error') }}
    </div>
@endif

@if (session()->has('delete_message'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Success!</span> {{ session('delete_message') }}
    </div>
@endif
