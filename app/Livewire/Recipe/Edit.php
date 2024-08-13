<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $recipeId;
    public $name;
    public $ingredients;
    public $description;
    public $image;

    public function mount($id)
    {
        $recipe = Recipe::findOrFail($id);
        $this->recipeId = $recipe->id;
        $this->name = $recipe->name;
        $this->ingredients = $recipe->ingredients;
        $this->description = $recipe->description;
         // Load existing image path if needed
    }

    public function updateRecipe()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // 1MB Max
        ]);


        if ($this->image) {
            $imagePath = $this->image->store('recipes', 'public');
        }

        $recipe = Recipe::findOrFail($this->recipeId);
        $recipe->update([
            'name' => $this->name,
            'ingredients' => $this->ingredients,
            'description' => $this->description,
            'image_path' => $imagePath  // Update or keep the old image path
        ]);

        session()->flash('message', 'Recipe updated successfully.');

        return redirect()->route('index');
    }

    public function cancel(){
        $this->reset('name','ingredients','description','image');
        return redirect()->route('index');

    }

    public function render()
    {
        return view('livewire.recipe.edit');
    }
}
