<?php

namespace App\Policies;

use App\Models\CoffeeShop;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoffeeShopPolicy
{
    /**
     * Determine whether the user can view any models.
     * Guest can view, authenticated users can view, admin can view
     */
    public function viewAny(?User $user): bool
    {
        return true; // Everyone can view the list
    }

    /**
     * Determine whether the user can view the model.
     * Everyone can view individual coffee shops
     */
    public function view(?User $user, CoffeeShop $coffeeShop): bool
    {
        return true; // Everyone can view
    }

    /**
     * Determine whether the user can create models.
     * Only authenticated users (not guests) can create
     */
    public function create(?User $user): bool
    {
        return $user !== null; // Only authenticated users
    }

    /**
     * Determine whether the user can update the model.
     * Owner or admin can update
     */
    public function update(?User $user, CoffeeShop $coffeeShop): bool
    {
        if ($user === null) {
        return false;
        }
        return $user->id === $coffeeShop->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     * Owner or admin can delete
     */
    public function delete(?User $user, CoffeeShop $coffeeShop): bool
    {
        if ($user === null) {
        return false;
        }
        return $user->id === $coffeeShop->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CoffeeShop $coffeeShop): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CoffeeShop $coffeeShop): bool
    {
        return false;
    }
}
