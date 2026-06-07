<?php

namespace App\Observers;

use App\Models\TaskKAL;

class TaskObserverKAL
{
    public function creating(TaskKAL $task)
    {
        if (!$task->status) {
            $task->status = 'pending';
        }

        if (!$task->priority) {
            $task->priority = 'medium';
        }
    }
}
