<?php

namespace App\Policies;

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
        return $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can view the vacation request.
     */
    public function view(User $user, VacationRequest $vacationRequest): bool
    {
        return $user->role->name === 'admin' || $user->id === $vacationRequest->user_id;
    }

    /**
     * Determine whether the user can create vacation requests.
     */
    public function create(User $user): bool
    {
        return $user->role->name === 'employee';
    }

    /**
     * Determine whether the user can update the vacation request.
     */
    public function update(User $user, VacationRequest $vacationRequest): bool
    {
        return $user->role->name === 'admin' || 
            ($user->id === $vacationRequest->user_id && $vacationRequest->status === 'pending');
    }

    /**
     * Determine whether the user can delete the vacation request.
     */
    public function delete(User $user, VacationRequest $vacationRequest): bool
    {
        return $user->role->name === 'admin' || 
            ($user->id === $vacationRequest->user_id && $vacationRequest->status === 'pending');
    }

    /**
     * Determine whether the user can approve the vacation request.
     */
    public function approve(User $user): bool
    {
        return $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can reject the vacation request.
     */
    public function reject(User $user): bool
    {
        return $user->role->name === 'admin';
    }
} 