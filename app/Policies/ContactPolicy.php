<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can submit a contact form.
     */
    public function submit(?User $user): bool
    {
        return true;
    }
}
