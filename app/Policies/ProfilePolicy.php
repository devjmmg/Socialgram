<?php

namespace App\Policies;

use App\Models\User;

class ProfilePolicy
{
    
    public function update(User $user, User $model): bool
    {
        return $user->username === $model->username;
    }

}
