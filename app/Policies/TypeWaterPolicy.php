<?php

namespace App\Policies;

use App\Models\TypeWater;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypeWaterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any water types.
     */
    public function viewAny(User $user): bool
    {
        // Anyone can view water types
        return true;
    }

    /**
     * Determine whether the user can view the water type.
     */
    public function view(User $user): bool
    {
        // Anyone can view individual water types
        return true;
    }

    /**
     * Determine whether the user can create water types.
     */
    public function create(User $user): bool
    {
        // Only admins can create water types
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can update the water type.
     */
    public function update(User $user): bool
    {
        // Only admins can update water types
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the water type.
     */
    public function delete(User $user): bool
    {
        // Only admins can delete water types
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can restore the water type.
     */
    public function restore(User $user): bool
    {
        // Only admins can restore soft-deleted water types
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can permanently delete the water type.
     */
    public function forceDelete(User $user): bool
    {
        // Only admins can permanently delete water types
        return $user->role_id === 1;
    }
} 