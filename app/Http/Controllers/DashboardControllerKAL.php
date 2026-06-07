<?php

namespace App\Http\Controllers;

use App\Models\CategoryKAL;
use App\Models\TaskKAL;

class DashboardControllerKAL extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $tasks = TaskKAL::with(['category', 'assignee'])->forUser($user)->latest()->get();

        return view('dashboard', [
            'totalTasks' => $tasks->count(),
            'openTasks' => $tasks->whereIn('status', ['pending', 'in_progress'])->count(),
            'completedTasks' => $tasks->where('status', 'completed')->count(),
            'dueSoonTasks' => $tasks->filter(fn ($task) => $task->deadline && $task->deadline->between(today(), today()->addDays(3)))->count(),
            'recentTasks' => $tasks->take(6),
            'categories' => CategoryKAL::withCount('tasks')->get(),
        ]);
    }
}
