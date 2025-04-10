<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function create(User $user): bool
    {
        return $user->role_id === 1;
    }

    public function update(User $user): bool
    {
        return $user->role_id === 1;
    }

    public function delete(User $user): bool
    {
        return $user->role_id === 1;
    }

    public function authorize(User $user): bool
    {
        return $user->role_id === 1;
    }

    public function view(User $user): bool
    {
        return $user->role_id === 1;
    }

    public function viewClient(): bool
    {
        return true;
    }
}
