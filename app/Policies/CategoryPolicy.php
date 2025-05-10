<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     */
    public function viewAny(User $user): bool
    {
        // Anyone can view categories
        return true;
    }

    /**
     * Determine whether the user can view the category.
     */
    public function view(User $user): bool
    {
        // Anyone can view individual categories
        return true;
    }

    /**
     * Determine whether the user can create categories.
     */
    public function create(User $user): bool
    {
        // Only admins can create categories
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can update the category.
     */
    public function update(User $user): bool
    {
        // Only admins can update categories
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the category.
     */
    public function delete(User $user, Category $category): bool
    {
        // Only admins can delete categories
        if($user->role_id === 1) {
            return !$this->hasProductsWithCategoryId($category->id);
        }
        return false;
    }

    /**
     * Determine whether the user can restore the category.
     */
    public function restore(User $user): bool
    {
        // Only admins can restore soft-deleted categories
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can permanently delete the category.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        // Only admins can delete categories
        if($user->role_id === 1) {
            return !$this->hasProductsWithCategoryId($category->id);
        }
        return false;
    }

    /**
     * Check if there are products associated with the given category ID.
     */
    private function hasProductsWithCategoryId(int $categoryId): bool
    {
        return Product::where('category_id', $categoryId)->exists();
    }
}
