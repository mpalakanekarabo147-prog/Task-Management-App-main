<?php

namespace App\Http\Controllers;

use App\Models\TaskKAL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileControllerKAL extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $personalTasksQuery = TaskKAL::with('category')
            ->where(function ($query) use ($user) {
                $query->where('created_by', $user->id)
                    ->orWhere('assigned_to', $user->id);
            });

        $status = $request->query('status');
        $filteredTasks = (clone $personalTasksQuery)
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();

        $allPersonalTasks = (clone $personalTasksQuery)->get();

        return view('profile.show', [
            'user' => $user,
            'status' => $status,
            'tasksCreated' => TaskKAL::where('created_by', $user->id)->count(),
            'tasksAssigned' => TaskKAL::where('assigned_to', $user->id)->count(),
            'completedTasks' => (clone $personalTasksQuery)->where('status', 'completed')->count(),
            'pendingTasks' => (clone $personalTasksQuery)->where('status', 'pending')->count(),
            'inProgressTasks' => (clone $personalTasksQuery)->where('status', 'in_progress')->count(),
            'filteredTasks' => $filteredTasks,
            'tasksByCategory' => $allPersonalTasks->groupBy(fn ($task) => optional($task->category)->name ?? 'Uncategorized'),
            'tasksByPriority' => $allPersonalTasks->groupBy('priority'),
            'dueTodayTasks' => (clone $personalTasksQuery)->whereDate('deadline', today())->whereIn('status', ['pending', 'in_progress'])->get(),
            'dueThisWeekTasks' => (clone $personalTasksQuery)->whereBetween('deadline', [today()->toDateString(), today()->addWeek()->toDateString()])->whereIn('status', ['pending', 'in_progress'])->get(),
            'overdueTasks' => (clone $personalTasksQuery)->whereDate('deadline', '<', today())->whereIn('status', ['pending', 'in_progress'])->get(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $directory = public_path('profile-avatars');
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            $filename = 'user-' . $user->id . '-' . time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move($directory, $filename);
            $data['avatar_path'] = 'profile-avatars/' . $filename;
        }

        $user->update($data);

        return back()->with('status', 'Profile updated successfully.');
    }

    public function updateSettings(Request $request)
    {
        $request->user()->update([
            'deadline_reminder_emails' => $request->boolean('deadline_reminder_emails'),
            'task_assignment_notifications' => $request->boolean('task_assignment_notifications'),
            'status_update_alerts' => $request->boolean('status_update_alerts'),
        ]);

        return back()->with('status', 'Notification settings saved successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($data['password'])]);

        return back()->with('status', 'Password updated successfully.');
    }

    public function showNotificationSettings(Request $request)
    {
        $user = $request->user();
        return view('profile.notification-settings', compact('user'));
    }
}
