<x-app-layout title="{{ $task->title }}">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-3">
        <div>
            <h1 class="h3 mb-1">{{ $task->title }}</h1>
            <p class="text-muted mb-0">{{ optional($task->category)->name ?? 'Uncategorized' }} · assigned to {{ optional($task->assignee)->name ?? 'Unassigned' }}</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a class="btn btn-outline-secondary" href="{{ route('tasks.index') }}">Back to Tasks</a>
            <a class="btn btn-outline-primary" href="{{ route('tasks.edit', $task) }}">Edit</a>
            @if(auth()->user()->isAdmin() && $task->assignee)
                <form method="POST" action="{{ route('reminders.task', $task) }}">
                    @csrf
                    <button class="btn btn-outline-warning" type="submit">Send deadline reminder</button>
                </form>
            @endif
            @can('delete', $task)
                <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger">Delete</button>
                </form>
            @endcan
        </div>
    </div>

    <div class="card surface-card mb-4">
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-md-6">
                    <strong class="text-muted">Status</strong>
                    <div class="mt-2">
                        <span class="badge bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'warning text-dark' : 'secondary') }}">{{ str_replace('_', ' ', ucfirst($task->status)) }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <strong class="text-muted">Priority</strong>
                    <div class="mt-2">{{ $task->priority_label }}</div>
                </div>
                <div class="col-md-6">
                    <strong class="text-muted">Deadline</strong>
                    <div class="mt-2">{{ optional($task->deadline)->format('d M Y') ?? 'No deadline' }}</div>
                </div>
                <div class="col-md-6">
                    <strong class="text-muted">Created by</strong>
                    <div class="mt-2">{{ optional($task->creator)->name ?? 'Unknown' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card surface-card">
        <div class="card-body">
            <h4 class="h5 mb-3" style="color: #1E3A5F;">Task Details</h4>
            @if($task->image)
                <img src="{{ asset('images/' . $task->image) }}" alt="Task image" class="img-fluid rounded mb-3" style="max-height:300px; width:100%; object-fit:cover;">
            @endif
            <p class="mb-3 text-muted">{{ $task->description ?: 'No description provided for this task yet.' }}</p>
            @if($task->tags)
                <div class="mb-4">
                    <strong class="text-muted">Tags</strong>
                    <div class="mt-2">
                        @foreach($task->tags as $tag)
                            <span class="badge bg-secondary text-white me-1 mb-1">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="border rounded p-3">
                        <small class="text-muted">Created at</small>
                        <div>{{ $task->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="border rounded p-3">
                        <small class="text-muted">Last updated</small>
                        <div>{{ $task->updated_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
