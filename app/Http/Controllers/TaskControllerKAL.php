<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequestKAL;
use App\Models\CategoryKAL;
use App\Models\TaskKAL;
use App\Models\User;
use Illuminate\Http\Request;

class TaskControllerKAL extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', TaskKAL::class);

        $categories = CategoryKAL::orderBy('name')->get();

        $tasks = TaskKAL::with(['category', 'assignee'])
            ->forUser($request->user())
            ->when($request->filled('search'), fn ($query) => $query->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
            }))
            ->when($request->filled('category_id'), fn ($query) => $query->where('category_id', $request->category_id))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('priority'), fn ($query) => $query->where('priority', $request->priority))
            ->when($request->filled('sort'), function ($query) use ($request) {
                return match ($request->sort) {
                    'oldest' => $query->oldest('created_at'),
                    'deadline_asc' => $query->orderBy('deadline', 'asc'),
                    'deadline_desc' => $query->orderBy('deadline', 'desc'),
                    default => $query->latest(),
                };
            })
            ->paginate(10)
            ->withQueryString();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', TaskKAL::class);
        return view('tasks.create', $this->formData());
    }

    public function store(StoreTaskRequestKAL $request)
    {
        $data = $this->validatedData($request);
        $this->ensureAssignmentIsAllowed($request, $data);
        $data['created_by'] = $request->user()->id;
        $taskImages = ['task-picture.jpg', 'task-picture2.jpg', 'task-picture3.jpg'];
        $data['image'] = $taskImages[array_rand($taskImages)];

        $task = TaskKAL::create($data);

        return redirect()->route('tasks.confirmation', $task);
    }

    public function confirmation(TaskKAL $task)
    {
        $this->authorize('view', $task);
        return view('tasks.confirmation', compact('task'));
    }

    public function show(TaskKAL $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(TaskKAL $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', array_merge($this->formData(), compact('task')));
    }

    public function update(StoreTaskRequestKAL $request, TaskKAL $task)
    {
        $data = $this->validatedData($request);
        $this->ensureAssignmentIsAllowed($request, $data);
        $task->update($data);

        return redirect()->route('tasks.show', $task)->with('status', 'Task updated successfully.');
    }

    public function destroy(TaskKAL $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('status', 'Task deleted successfully.');
    }

    public function assigned(Request $request)
    {
        $this->authorize('viewAny', TaskKAL::class);

        $categories = CategoryKAL::orderBy('name')->get();

        $tasks = TaskKAL::with(['category', 'assignee'])
            ->where('assigned_to', $request->user()->id)
            ->when($request->filled('search'), fn ($query) => $query->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
            }))
            ->when($request->filled('category_id'), fn ($query) => $query->where('category_id', $request->category_id))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('priority'), fn ($query) => $query->where('priority', $request->priority))
            ->when($request->filled('sort'), function ($query) use ($request) {
                return match ($request->sort) {
                    'oldest' => $query->oldest('created_at'),
                    'deadline_asc' => $query->orderBy('deadline', 'asc'),
                    'deadline_desc' => $query->orderBy('deadline', 'desc'),
                    default => $query->latest(),
                };
            })
            ->paginate(10)
            ->withQueryString();

        return view('tasks.assigned', compact('tasks', 'categories'));
    }

    private function validatedData(StoreTaskRequestKAL $request)
    {
        $data = $request->validated();

        $data['tags'] = $this->formatTags($data['tags'] ?? null);

        return $data;
    }

    private function formatTags(?string $tags): ?array
    {
        if (!$tags) {
            return null;
        }

        $cleaned = array_filter(array_map('trim', explode(',', $tags)));

        return count($cleaned) ? array_values($cleaned) : null;
    }

    private function ensureAssignmentIsAllowed(Request $request, array &$data): void
    {
        if (! $request->user()->isAdmin()) {
            $data['assigned_to'] = $request->user()->id;
        }
    }

    private function formData()
    {
        $users = request()->user()->isAdmin()
            ? User::whereIn('role', ['admin', 'team_member'])->orderBy('name')->get()
            : collect([request()->user()]);

        return [
            'categories' => CategoryKAL::orderBy('name')->get(),
            'users' => $users,
        ];
    }
}
