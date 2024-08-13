<div wire:key="{{ $recipe->id }}" class="bg-white rounded-lg shadow-md overflow-hidden w-72 mt-6">
    @if ($recipe->image_path)
        <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="Recipe Image" class="w-full h-48 object-cover">
    @endif
    <div class="p-4">
        <h5 class="text-lg font-bold mb-2">{{ $recipe->name }}</h5>
        <p class="text-gray-600 mb-4">{{ str($recipe->description)->words(8) }}</p>

        <!-- Display the creation date and time -->
        <p class="text-gray-500 text-sm mb-4">
            Created on: {{ $recipe->created_at->format('F j, Y \a\t h:i A') }}
        </p>

        <div class="flex justify-between">
            <!-- View Full Recipe Button triggers the modal -->
            <button wire:click="showRecipe({{ $recipe->id }})" class="text-blue-600 hover:text-blue-900 transition duration-300 ease-in-out">View Full Recipe</button>
            <div class="flex items-center">
                @can('modify', $recipe)
                    <a wire:navigate href="{{ url('/edit/' . $recipe->id) }}" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <button wire:click ='deleteRecipe({{$recipe->id}})'type="button" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6"></path>
                        </svg>
                    </button>
                @endcan
            </div>
        </div>
    </div>
</div>
