<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any transactions.
     */
    public function viewAny(User $user): bool
    {
        // Only admins can view all transactions
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can view the transaction.
     */
    public function view(User $user): bool
    {
        // Admins can view any
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can create transactions.
     */
    public function create(User $user): bool
    {
        // Only authenticated users can create transactions
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can update the transaction.
     */
    public function update(User $user, Transaction $transaction): bool
    {
        // Only admins can update transactions
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the transaction.
     */
    public function delete(User $user, Transaction $transaction): bool
    {
        // Only admins can delete transactions
        return $user->role_id === 1;
    }
}
