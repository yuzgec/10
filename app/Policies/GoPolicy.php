<?php

namespace App\Policies;

use App\Models\User;

class GoPolicy
{
    public function access(User $user): bool
    {
        // Spatie Permission ile kullanıcının birden fazla rolden birine sahip olup olmadığını kontrol eder.
        $allowedRoles = ['admin']; // Burada daha fazla rol ekleyebilirsiniz.
        return $user->hasAnyRole($allowedRoles);
    }
}
