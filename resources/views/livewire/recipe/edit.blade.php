<section class="bg-blue-200 dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update Recipe</h2>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ session('message') }}</strong>
            </div>
        @endif

        <form wire:submit.prevent="updateRecipe">
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label for="recipe_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recipe Name</label>
                    <input type="text" name="recipe_name" id="recipe_name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type recipe name" required>
                </div>

                <div class="sm:col-span-2">
                    <label for="ingredients" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingredients</label>
                    <textarea name="ingredients" id="ingredients" wire:model="ingredients" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="List the ingredients" required></textarea>
                </div>

                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea name="description" id="description" wire:model="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a recipe description here..." required></textarea>
                </div>

                <div class="sm:col-span-2">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recipe Image</label>
                    <input type="file" name="image" id="image" wire:model="image" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">

                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" alt="Image preview" class="mt-4">
                    @endif
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Hide Update Recipe button while loading -->
                <button wire:loading.remove wire:target="image" type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Update Recipe
                </button>

                <!-- Show loading message while the image is uploading -->
                <div wire:loading wire:target="image" class="text-gray-600 dark:text-gray-400">
                    Uploading image, please wait...
                </div>

                <!-- Cancel button -->
                <button wire:click.prevent="cancel" type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</section>
