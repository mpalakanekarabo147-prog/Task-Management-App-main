<?php

namespace App\Notifications;

use App\Models\TaskKAL;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDeadlineReminderKAL extends Notification
{
    use Queueable;

    public function __construct(private TaskKAL $task)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task deadline reminder: ' . $this->task->title . ' due ' . optional($this->task->deadline)->format('d M Y'))
            ->greeting('Hello ' . $notifiable->name)
            ->line('This is a reminder that one of your assigned tasks is due soon.')
            ->line('Task: ' . $this->task->title)
            ->line('Priority: ' . ucfirst($this->task->priority))
            ->line('Status: ' . str_replace('_', ' ', ucfirst($this->task->status)))
            ->line('Deadline: ' . optional($this->task->deadline)->format('d M Y'))
            ->action('View task', route('tasks.show', $this->task))
            ->line('Please update the task status after progress is made.');
    }
}
