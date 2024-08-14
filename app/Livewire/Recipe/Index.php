<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;
    public $modalRecipe;
    public $selectedRecipeId;
    public $search;
    public $sortBy = ''; // Default sorting
    public $sortDirection = 'desc'; // Default direction


    public function updatedSortBy($value)
    {
        if ($value === 'name') {
            $this->sortDirection = 'asc'; // A-Z
        }
        elseif ($value === 'created_at') {
            $this->sortDirection = 'desc'; // Newest first
        }
        else {
            $this->sortBy = ''; // Reset sorting
        }
    }


    public function showRecipe(Recipe $recipe)
    {
        $this->selectedRecipeId = $recipe->id;
        $this->modalRecipe = Recipe::find($recipe->id);
        $this->dispatch('open-modal', name: 'recipe_details');
    }

    public function deleteRecipe($recipeId)
{
    DB::beginTransaction();
    try {
        // Attempt to find and delete the recipe
        $recipe = Recipe::findOrFail($recipeId);
        $recipe->delete();
        DB::commit();
        session()->flash('delete_message', 'Recipe deleted successfully.');

    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Failed to delete Recipe: ' . $e->getMessage());
        session()->flash('delete_error', 'Recipe no longer exists.');
    }
    return redirect()->route('index');
}


    #[Computed]
    public function recipes()
    {
        return Recipe::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(8);
    }

    public function render()
    {
        return view('livewire.recipe.index');
    }
}
