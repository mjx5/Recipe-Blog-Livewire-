<div>
    <!-- Recipe Cards Section -->
    <div class="flex flex-col md:flex-row justify-between mt-10">
        <div class="w-full md:w-8/12">
            <!-- Display Delete Error if it exists -->
            @if (session()->has('delete_error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Error!</span> {{ session('delete_error') }}
                </div>
            @endif

            <!-- Search bar with Filter -->
            @include('livewire.includes.search-bar')
        </div>

        <!-- Create Recipe Button -->
        @include('livewire.includes.create-button')
    </div>

    <!-- Check if there are recipes to display -->
    @if ($this->recipes()->isEmpty())
        <div class="flex justify-center mt-10">
            <p class="text-gray-600">No items found for your search.</p>
        </div>
    @else
        <!-- Recipe Cards - Horizontal Layout -->
        <div class="flex flex-wrap justify-center space-x-6">
            @foreach ($this->recipes() as $recipe)
                @include('livewire.includes.recipe-card')
            @endforeach
        </div>
    @endif

    <!-- Pagination Links -->
    <div class="flex justify-center mt-6">
        {{ $this->recipes()->links() }}
    </div>

    <!-- Modal Component -->
    <x-show-modal name="recipe_details">
        @slot('body')
        @if ($selectedRecipeId)
            <div class="p-6 bg-gray-800 text-white rounded-lg shadow-lg">
                <!-- Recipe Title -->
                <h2 class="text-3xl font-bold mb-4 border-b-2 border-gray-600 pb-2">
                    Recipe name: {{ $modalRecipe->name }}
                </h2>

                <!-- Recipe Description -->
                <p class="text-gray-300 mb-6">
                    Description: {{ $modalRecipe->description }}
                </p>
                <!-- Recipe Ingredients -->
                <p class="text-gray-300 mb-6">
                    Ingredients: {{ $modalRecipe->ingredients }}
                </p>
                <p class="text-gray-300 mb-6">
                    Created By: {{ $modalRecipe->user->name }}
                </p>
            </div>
        @endif
        @endslot
    </x-show-modal>
</div>
