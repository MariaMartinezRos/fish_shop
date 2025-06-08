<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacationRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any vacation requests.
     */
    public function viewAny(User $user): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can view the vacation requests.
     */
    public function view(User $user, VacationRequest $vacationRequest): bool
    {
        return $user->role_id === 1 ||( $vacationRequest->user_id === $user->id);
    }

    /**
     * Determine whether the user can create vacation requests.
     */
    public function create(User $user): bool
    {
        return $user->role_id === 1 || $user->role_id === 2;
    }

    /**
     * Determine whether the user can update the vacation requests.
     */
    public function update(User $user): bool
    {
        return $user->role_id === 1 || $user->role_id === 2;
    }

    /**
     * Determine whether the user can delete the vacation requests.
     */
    public function delete(User $user): bool
    {
        return $user->role_id === 1 || $user->role_id === 2;
    }
}
