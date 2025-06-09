<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PdfPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can generate PDFs.
     */
    public function generate(?User $user): bool
    {
        return true;
    }
}
