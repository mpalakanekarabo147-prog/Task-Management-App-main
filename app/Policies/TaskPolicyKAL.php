<?php

namespace App\Policies;

use App\Models\TaskKAL;
use App\Models\User;

class TaskPolicyKAL
{
    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'team_member', 'guest']);
    }

    public function view(User $user, TaskKAL $task)
    {
        return $user->isAdmin() || $task->assigned_to === $user->id || $task->created_by === $user->id;
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'team_member']);
    }

    public function update(User $user, TaskKAL $task)
    {
        return $user->isAdmin() || $task->assigned_to === $user->id || $task->created_by === $user->id;
    }

    public function delete(User $user, TaskKAL $task)
    {
        return $user->isAdmin() || $task->created_by === $user->id;
    }
}
