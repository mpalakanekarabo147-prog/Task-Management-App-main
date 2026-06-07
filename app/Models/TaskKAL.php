<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskKAL extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'category_id',
        'assigned_to',
        'created_by',
        'title',
        'description',
        'image',
        'tags',
        'priority',
        'status',
        'deadline',
        'reminder_sent_at',
    ];

    protected $casts = [
        'deadline' => 'date',
        'reminder_sent_at' => 'datetime',
        'tags' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryKAL::class, 'category_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeOpen($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress']);
    }

    public function scopeForUser($query, User $user)
    {
        if ($user->isAdmin()) {
            return $query;
        }

        return $query->where('assigned_to', $user->id)->orWhere('created_by', $user->id);
    }

    public function getPriorityLabelAttribute()
    {
        return ucfirst($this->priority);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = trim($value);
    }
}
