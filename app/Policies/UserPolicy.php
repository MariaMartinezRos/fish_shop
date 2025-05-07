<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the user.
     */
    public function view(User $user): bool
    {
        // , ?User $model = null
        // Users can view their own profile, admins can view any profile
        // return $user->id === $model->id || $user->role_id === 1;
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can create users.
     */
    public function create(User $user): bool
    {
        // Only admins can create new users
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can update the user.
     */
    public function update(User $user): bool
    {
        // Users can update their own profile, admins can update any profile
        // return $user->id === $model->id || $user->role_id === 1;
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the user.
     */
    public function delete(User $user): bool
    {
        // Users cannot delete themselves, only admins can delete users
        // return $user->role_id === 1 && $user->id !== $model->id;
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can restore the user.
     */
    public function restore(User $user): bool
    {
        // Only admins can restore soft-deleted users
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can permanently delete the user.
     */
    public function forceDelete(User $user): bool
    {
        // Only admins can permanently delete users
        // return $user->role_id === 1 && $user->id !== $model->id;
        return $user->role_id === 1;    }

    /**
     * Determine whether the user can perform any action.
     */
    public function authorize(User $user): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can view client information.
     */
    public function viewClient(): bool
    {
        return true;
    }
}
