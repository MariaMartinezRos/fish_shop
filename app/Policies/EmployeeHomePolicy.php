<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeHomePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the employee home page.
     */
    public function view(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $user->role_id === 1 || $user->role_id === 2;
    }
}
