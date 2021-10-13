<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function enabled(User $user) {
        if($user->enabled == 1) {
            return true;
        }
        return false;
    }
}
