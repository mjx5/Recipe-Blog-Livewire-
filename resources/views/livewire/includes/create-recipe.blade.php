<div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
    <!-- Recipe Name Input -->
    <div class="sm:col-span-2">
        <label for="recipeName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recipe Name</label>
        <input type="text" id="recipeName" wire:model="recipeName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        @error('recipeName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Description Input -->
    <div class="sm:col-span-2">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
        <textarea id="description" wire:model="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
        @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Ingredients Input -->
    <div class="sm:col-span-2">
        <label for="ingredients" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingredients</label>
        <textarea id="ingredients" wire:model="ingredients" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
        @error('ingredients') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Image Input -->
    <div class="sm:col-span-2">
        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
        <input type="file" id="image" wire:model="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        <!-- Preview the image before uploading -->
        @if ($image)
            <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="mt-4 rounded-lg shadow-lg max-h-48">
        @endif
    </div>
</div>
