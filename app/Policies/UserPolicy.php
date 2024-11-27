<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function admin(User $user)
    {
        return $user->access_type == 'admin';
    }
    public function student(User $user)
    {
        return $user->access_type == 'student';
    }
    public function teacher(User $user)
    {
        return $user->access_type == 'teacher';
    }
}
