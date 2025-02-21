<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    public function create(User $user): bool
    {
        return $user->role_id === 'admin';
    }

    public function update(User $user): bool
    {
        return $user->role_id === 'admin';
    }

    public function delete(User $user): bool
    {
        return $user->role_id === 'admin';
    }

    public function authorize(User $user): bool
    {
        return $user->role_id === 'admin';
    }

    public function view(User $user): bool
    {
        return $user->role_id === 'admin';
    }

    public function viewClient(): bool
    {
        return true;
    }
}
