<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Recipe;

class RecipePolicy
{
    /**
     * Determine whether the user can modify the recipe.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recipe  $recipe
     * @return bool
     */
    public function modify(User $user, Recipe $recipe)
    {
        // Check if the user is the owner of the recipe
        return $recipe->user_id === $user->id;
    }
}
