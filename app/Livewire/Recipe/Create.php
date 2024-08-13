<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $recipeName;
    public $description;
    public $ingredients;
    public $image; // Property to hold the uploaded image

    protected $rules = [
        'recipeName' => 'required|string|min:5',
        'description' => 'required|string',
        'ingredients' => 'required|string',
        'image' => 'required|image|max:2048', // Validate image type and size
    ];

    public function createRecipe()
    {

        
        $this->validate();

        // Handle image upload
        $imagePath = $this->image->store('recipes', 'public');

        Recipe::create([
            'name' => $this->recipeName,
            'description' => $this->description,
            'ingredients' => $this->ingredients,
            'image_path' => $imagePath, // Save the path to the image
            'user_id' => auth()->user()->id,
        ]);

        $this->reset('recipeName', 'description', 'ingredients', 'image');
        session()->flash('recipe_created', 'Recipe Created');
        return redirect()->to('/recipes');
    }

    public function render()
    {
        return view('livewire.recipe.create');
    }
}
