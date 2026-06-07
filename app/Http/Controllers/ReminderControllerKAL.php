<?php

namespace App\Http\Controllers;

use App\Models\TaskKAL;
use App\Notifications\TaskDeadlineReminderKAL;
use Illuminate\Support\Facades\Log;

class ReminderControllerKAL extends Controller
{
    public function show()
    {
        return view('reminders.send');
    }

    public function sendForTask(TaskKAL $task)
    {
        if (!$task->assignee) {
            return back()->with('error', 'This task has no assignee to send a reminder to.');
        }

        try {
            $task->assignee->notify(new TaskDeadlineReminderKAL($task));
            $task->forceFill(['reminder_sent_at' => now()])->save();
        } catch (\Throwable $exception) {
            Log::error('Failed to send deadline reminder for task ' . $task->id . ': ' . $exception->getMessage());
            return back()->with('error', 'Failed to send reminder. Check mail configuration.');
        }

        return back()->with('status', 'Deadline reminder sent to ' . $task->assignee->name . '.');
    }

    public function send()
    {
        $tasks = TaskKAL::with('assignee')
            ->whereHas('assignee', fn ($query) => $query
                ->where('deadline_reminder_emails', true)
                ->whereNotNull('email')
            )
            ->whereNull('reminder_sent_at')
            ->whereIn('status', ['pending', 'in_progress'])
            ->whereBetween('deadline', [today()->toDateString(), today()->addDays(2)->toDateString()])
            ->get();

        if ($tasks->isEmpty()) {
            return back()->with('status', 'No deadline reminders were sent. Either there are no assigned tasks due in the next two days, or the assignee has reminders disabled.');
        }

        $errors = [];

        foreach ($tasks as $task) {
            try {
                $task->assignee->notify(new TaskDeadlineReminderKAL($task));
                $task->forceFill(['reminder_sent_at' => now()])->save();
            } catch (\Throwable $exception) {
                Log::error('Failed to send deadline reminder for task ' . $task->id . ': ' . $exception->getMessage(), [
                    'task_id' => $task->id,
                    'assignee_id' => $task->assigned_to,
                ]);
                $errors[] = $exception->getMessage();
            }
        }

        $message = "Reminder emails were sent for {$tasks->count()} deadline reminder task(s).";

        if (!empty($errors)) {
            $message .= ' Some emails could not be delivered; check mail configuration.';
        }

        return back()->with('status', $message);
    }
}
