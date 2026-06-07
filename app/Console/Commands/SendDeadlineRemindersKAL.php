<?php

namespace App\Console\Commands;

use App\Models\TaskKAL;
use App\Notifications\TaskDeadlineReminderKAL;
use Illuminate\Console\Command;

class SendDeadlineRemindersKAL extends Command
{
    protected $signature = 'taskflow:send-deadline-reminders {--days=2 : Number of days ahead to check}';

    protected $description = 'Send email deadline reminders for TaskFlow tasks that are due soon.';

    public function handle()
    {
        $days = (int) $this->option('days');

        $tasks = TaskKAL::with('assignee')
            ->whereNotNull('assigned_to')
            ->whereNull('reminder_sent_at')
            ->whereIn('status', ['pending', 'in_progress'])
            ->whereBetween('deadline', [today()->toDateString(), today()->addDays($days)->toDateString()])
            ->get();

        foreach ($tasks as $task) {
            $task->assignee->notify(new TaskDeadlineReminderKAL($task));
            $task->forceFill(['reminder_sent_at' => now()])->save();
        }

        $this->info("Sent {$tasks->count()} deadline reminder(s).");

        return self::SUCCESS;
    }
}
