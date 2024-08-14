<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
        // Validate input
        $this->validate();

        // Start a transaction
        DB::beginTransaction();

        try {
            // Handle image upload
            $imagePath = $this->image->store('recipes', 'public');

            // Create the recipe
            Recipe::create([
                'name' => $this->recipeName,
                'description' => $this->description,
                'ingredients' => $this->ingredients,
                'image_path' => $imagePath, // Save the path to the image
                'user_id' => auth()->user()->id,
            ]);

            // Commit the transaction
            DB::commit();

            // Reset the form and flash a success message
            $this->reset('recipeName', 'description', 'ingredients', 'image');
            session()->flash('recipe_created', 'Recipe created successfully.');
            return redirect()->to('/recipes');

        } catch (ValidationException $e) {
            // Rollback the transaction if validation fails
            DB::rollback();

            // Handle validation exceptions
            session()->flash('recipe_error', 'Validation failed: ' . $e->getMessage());
            return;

        } catch (\Exception $e) {
            // Rollback the transaction for any other exceptions
            DB::rollback();

            // Handle general exceptions
            session()->flash('recipe_error', 'Failed to create recipe: ' . $e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.recipe.create');
    }
}
