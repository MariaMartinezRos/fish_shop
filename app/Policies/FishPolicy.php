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
        return $user->role_id === 1 || $user->role->name === 'supplier';
    }

    /**
     * Determine whether the user can view the fish.
     */
    public function view(User $user): bool
    {
        return $user->role_id === 1 || $user->role->name === 'supplier';
    }

    /**
     * Determine whether the user can create fish.
     */
    public function create(User $user): bool
    {
        return $user->role_id === 1 || $user->role->name === 'supplier';
    }

    /**
     * Determine whether the user can update the fish.
     */
    public function update(User $user): bool
    {
        return $user->role_id === 1 || $user->role->name === 'supplier';
    }

    /**
     * Determine whether the user can delete the fish.
     */
    public function delete(User $user): bool
    {
        return $user->role_id === 1 || $user->role->name === 'supplier';
    }

    /**
     * Determine whether the user can restore the fish.
     */
    public function restore(User $user): bool
    {
        return $user->role_id === 1 || $user->role->name === 'supplier';
    }

    /**
     * Determine whether the user can permanently delete the fish.
     */
    public function forceDelete(User $user): bool
    {
        // Only admins can permanently delete fish entries
        return $user->role_id === 1 ;
    }
}
