<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     */
    public function viewAny(User $user): bool
    {
        // Anyone can view the product list
        return true;
    }

    /**
     * Determine whether the user can view the product.
     */
    public function view(User $user): bool
    {
        // Anyone can view individual products
        return true;
    }

    /**
     * Determine whether the user can create products.
     */
    public function create(User $user): bool
    {
        // Only admins can create products
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can update the product.
     */
    public function update(User $user): bool
    {
        // Only admins can update products
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the product.
     */
    public function delete(User $user): bool
    {
        // Only admins can delete products
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can restore the product.
     */
    public function restore(User $user): bool
    {
        // Only admins can restore soft-deleted products
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can permanently delete the product.
     */
    public function forceDelete(User $user): bool
    {
        // Only admins can permanently delete products
        return $user->role_id === 1;
    }

    public function authorize(User $user): bool
    {
        return $user->role_id === 1;
    }

    public function viewClient(): bool
    {
        return true;
    }
}
