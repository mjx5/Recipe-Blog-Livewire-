<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use Livewire\WithPagination;
use Livewire\Component;

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
        try {
            Recipe::findOrFail($recipeId)->delete();
        } catch (\Exception $e) {
            session()->flash('delete_error', 'Failed to delete Recipe');
            return;
        }
    }

    public function placeholder(){
        return view('placeholder');
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
