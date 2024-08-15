<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        $lockKey = 'recipe-update-' . auth()->user()->id;
        $lock = Cache::lock($lockKey, 10);

        DB::beginTransaction();

        try {
            if ($lock->get()) {
                $this->validate([
                    'name' => 'required|string|max:255',
                    'ingredients' => 'required|string',
                    'description' => 'required|string',
                    'image' => 'nullable|image|max:2048', // 2MB Max
                ]);

                if ($this->image) {
                    $imagePath = $this->image->store('recipes', 'public');
                }

                // Attempt to find and update the recipe
                $recipe = Recipe::findOrFail($this->recipeId);
                $recipe->update([
                    'name' => $this->name,
                    'ingredients' => $this->ingredients,
                    'description' => $this->description,
                    'image_path' => $this->image ? $imagePath : $recipe->image_path
                ]);
                DB::commit();

                session()->flash('message', 'Recipe updated successfully.');
                return redirect()->route('index');

            } else {

                session()->flash('update_error', 'The recipe is currently being updated by someone else. Please try again later.');
                DB::rollback();
                return redirect()->route('index');
            }
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            session()->flash('update_error', 'The recipe you are trying to update does not exist.');
            return redirect()->route('index');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('update_error', 'An error occurred: ' . $e->getMessage());
            return redirect()->route('index');
        } finally {
            // Always release the lock
            $lock->release();
        }
    }

    public function cancel()
    {
        $this->reset('name', 'ingredients', 'description', 'image');
        return redirect()->route('index');
    }

    public function render()
    {
        return view('livewire.recipe.edit');
    }
}
