<div class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Create Recipe</h2>

        <form wire:submit.prevent="createRecipe">
            @include('livewire.includes.create-recipe')
            <!-- Button that will be hidden when loading -->
            <button wire:loading.remove wire:target="image" type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Create Recipe
            </button>

            <!-- Loading spinner or text while the image is uploading -->
            <div wire:loading wire:target="image" class="mt-4 sm:mt-6 text-sm text-gray-600 dark:text-gray-400">
                Uploading image, please wait...
            </div>

        </form>
    </div>
</div>
