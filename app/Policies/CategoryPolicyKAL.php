<?php

namespace App\Policies;

use App\Models\CategoryKAL;
use App\Models\User;

class CategoryPolicyKAL
{
    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'team_member']);
    }

    public function view(User $user, CategoryKAL $category)
    {
        return in_array($user->role, ['admin', 'team_member']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'team_member']);
    }

    public function update(User $user, CategoryKAL $category)
    {
        return in_array($user->role, ['admin', 'team_member']);
    }

    public function delete(User $user, CategoryKAL $category)
    {
        return in_array($user->role, ['admin', 'team_member']);
    }
}
