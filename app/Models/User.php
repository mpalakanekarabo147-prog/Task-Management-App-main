<?php

namespace App\Models;

use App\Models\TaskKAL;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar_path',
        'deadline_reminder_emails',
        'task_assignment_notifications',
        'status_update_alerts',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'deadline_reminder_emails' => 'boolean',
        'task_assignment_notifications' => 'boolean',
        'status_update_alerts' => 'boolean',
    ];

    public function assignedTasks()
    {
        return $this->hasMany(TaskKAL::class, 'assigned_to');
    }

    public function createdTasks()
    {
        return $this->hasMany(TaskKAL::class, 'created_by');
    }

    public function getRoleLabelAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->role));
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeamMember()
    {
        return $this->role === 'team_member';
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar_path) {
            return asset($this->avatar_path);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=1E3A5F&color=fff';
    }
}

