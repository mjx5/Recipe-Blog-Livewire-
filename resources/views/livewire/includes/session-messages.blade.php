@if (session()->has('update_error'))
    <div id="updateError" class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
        <p class="font-bold">Error!</p>
        <p>{{ session('update_error') }}</p>
    </div>
@endif

@if (session()->has('logout_error'))
    <div id="logoutError" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Error!</span> {{ session('logout_error') }}
    </div>
@endif

@if (session()->has('delete_error'))
    <div id="deleteError" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Error!</span> {{ session('delete_error') }}
    </div>
@endif

@if (session()->has('delete_message'))
    <div id="deleteMessage" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Success!</span> {{ session('delete_message') }}
    </div>
@endif
@if (session()->has('recipe_error'))
    <div id="recipeError" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Success!</span> {{ session('recipe_error') }}
    </div>
@endif

@if (session()->has('message'))
    <div id="message" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">Success!</span> {{ session('message') }}
    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function() {
            let alerts = document.querySelectorAll('#updateError, #logoutError, #deleteError, #deleteMessage, #recipeError,#message');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500); // Adjust to match the fade-out transition
            });
        }, 3000); // 3 seconds delay before fading out
    });
</script>
