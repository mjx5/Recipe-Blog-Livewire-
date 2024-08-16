<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cache;
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
        $lockKey = 'recipe-create-' . auth()->user()->id; // Unique key for the current user
        $lock = Cache::lock($lockKey, 30); // Lock expires after 30 seconds
        try {
            if ($lock->get()) {
                DB::beginTransaction();
                $this->validate();
                $imagePath = $this->image->store('recipes', 'public');


                Recipe::create([
                    'name' => $this->recipeName,
                    'description' => $this->description,
                    'ingredients' => $this->ingredients,
                    'image_path' => $imagePath, // Save the path to the image
                    'user_id' => auth()->user()->id,
                ]);

                // Commit the transaction
                DB::commit();

                $this->reset('recipeName', 'description', 'ingredients', 'image');
                session()->flash('recipe_created', 'Recipe created successfully.');
                return redirect()->to('/recipes');

            } else {
                session()->flash('recipe_error', 'A recipe creation request is already in progress. Please try again later.');
                DB::rollback();
                $lock->release();
                return redirect()->route('index');

            }
        } catch (ValidationException $e) {
            // Rollback the transaction if validation fails
            DB::rollback();

            // Handle validation exceptions
            session()->flash('recipe_error', 'Validation failed: ' . $e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.recipe.create');
    }
}
