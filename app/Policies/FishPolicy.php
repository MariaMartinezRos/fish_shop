<?php

namespace App\Policies;

use App\Models\Fish;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FishPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any fish.
     */
    public function viewAny(User $user): bool
    {
        // Anyone can view the fish list
        return true;
    }

    /**
     * Determine whether the user can view the fish.
     */
    public function view(User $user, Fish $fish): bool
    {
        // Anyone can view individual fish
        return true;
    }

    /**
     * Determine whether the user can create fish.
     */
    public function create(User $user): bool
    {
        // Only admins can create fish entries
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can update the fish.
     */
    public function update(User $user, Fish $fish): bool
    {
        // Only admins can update fish entries
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the fish.
     */
    public function delete(User $user, Fish $fish): bool
    {
        // Only admins can delete fish entries
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can restore the fish.
     */
    public function restore(User $user, Fish $fish): bool
    {
        // Only admins can restore soft-deleted fish entries
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can permanently delete the fish.
     */
    public function forceDelete(User $user, Fish $fish): bool
    {
        // Only admins can permanently delete fish entries
        return $user->role_id === 1;
    }
} 