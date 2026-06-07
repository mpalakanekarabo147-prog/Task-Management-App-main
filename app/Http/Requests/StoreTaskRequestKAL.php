<?php

namespace App\Http\Requests;

use App\Rules\DeadlineAfterTodayKAL;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequestKAL extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('task')
            ? $this->user()?->can('update', $this->route('task')) ?? false
            : $this->user()?->can('create', \App\Models\TaskKAL::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'tags' => ['nullable', 'string', 'max:255'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'deadline' => ['nullable', 'date', new DeadlineAfterTodayKAL],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Please choose a task category.',
            'category_id.exists' => 'Please choose a valid task category.',
            'title.required' => 'Every task needs a clear title.',
            'assigned_to.exists' => 'Please choose a valid assignee.',
        ];
    }
}
