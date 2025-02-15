<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user): bool
    {
        return $user->role_id === 'admin' ||$user->hasPermissionTo('create product');
    }

    public function update(User $user): bool
    {
        return $user->role_id === 'admin' || $user->hasPermissionTo('edit product');
    }

    public function delete(User $user): bool
    {
        return $user->role_id === 'admin' || $user->hasPermissionTo('delete product');
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo('view product');
    }

    public function viewClient(User $user): bool
    {
        return $user->hasPermissionTo('view clients product');
    }
}
