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
        return $user->role_id === 1 || $user->role_id === 2;
    }

    /**
     * Determine whether the user can view the transaction.
     */
    public function view(User $user): bool
    {
        return $user->role_id === 1 || $user->role_id === 2;
    }

    /**
     * Determine whether the user can create transactions.
     */
    public function create(User $user): bool
    {
        return $user->role_id === 1 || $user->role_id === 2;
    }

    /**
     * Determine whether the user can update the transaction.
     */
    public function update(User $user): bool
    {
        return $user->role_id === 1 || $user->role_id === 2;
    }

    /**
     * Determine whether the user can delete the transaction.
     */
    public function delete(User $user): bool
    {
        return $user->role_id === 1 || $user->role_id === 2;
    }
}


//namespace App\Policies;
//
//use App\Models\Transaction;
//use App\Models\User;
//use Illuminate\Auth\Access\HandlesAuthorization;
//
//class TransactionPolicy
//{
//    use HandlesAuthorization;
//
//    /**
//     * Determine whether the user can view any transactions.
//     */
//    public function viewAny(User $user): bool
//    {
//        return $user->role_id === 1 || $user->role_id === 3; // Admin or Employee
//    }
//
//    /**
//     * Determine whether the user can view the transaction.
//     */
//    public function view(User $user, Transaction $transaction): bool
//    {
//        return $user->role_id === 1 || $user->role_id === 3; // Admin or Employee
//    }
//
//    /**
//     * Determine whether the user can create transactions.
//     */
//    public function create(User $user): bool
//    {
//        return $user->role_id === 1 || $user->role_id === 3; // Admin or Employee
//    }
//
//    /**
//     * Determine whether the user can update the transaction.
//     */
//    public function update(User $user, Transaction $transaction): bool
//    {
//        return $user->role_id === 1 || $user->role_id === 3; // Admin or Employee
//    }
//
//    /**
//     * Determine whether the user can delete the transaction.
//     */
//    public function delete(User $user, Transaction $transaction): bool
//    {
//        return $user->role_id === 1; // Only Admin
//    }
//}
