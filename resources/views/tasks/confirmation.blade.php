<x-app-layout title="Task Created">
    <div class="container py-4">
        <div class="card surface-card shadow-sm">
            <div class="card-body">
                <div class="text-center mb-4">
                    <span class="badge bg-success mb-3">Task created successfully</span>
                    <h1 class="h3 fw-bold" style="color: #1E3A5F;">Task confirmed</h1>
                    <p class="text-muted">Your task has been added to TechFlow and is ready for tracking by your team.</p>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <h5 class="mb-2">Task Summary</h5>
                            <p class="mb-1"><strong>Title:</strong> {{ $task->title }}</p>
                            <p class="mb-1"><strong>Category:</strong> {{ optional($task->category)->name ?? 'Uncategorized' }}</p>
                            <p class="mb-1"><strong>Assigned to:</strong> {{ optional($task->assignee)->name ?? 'Unassigned' }}</p>
                            <p class="mb-1"><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
                            <p class="mb-1"><strong>Status:</strong> {{ str_replace('_', ' ', ucfirst($task->status)) }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <h5 class="mb-2">Delivery Details</h5>
                            <p class="mb-1"><strong>Deadline:</strong> {{ optional($task->deadline)->format('d M Y') ?? 'No deadline set' }}</p>
                            <p class="mb-1"><strong>Created by:</strong> {{ optional($task->creator)->name ?? auth()->user()->name }}@if(optional($task->creator)->id === auth()->id()) <span class="text-success">(you)</span>@endif</p>
                            @if($task->tags)
                                <div class="mt-2">
                                    <strong>Tags:</strong>
                                    <div class="mt-1">
                                        @foreach($task->tags as $tag)
                                            <span class="badge bg-secondary text-white me-1 mb-1">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card surface-card">
                    <div class="card-body">
                        <h5 class="mb-3">Next steps</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">• Review the task details and add attachments or comments if needed.</li>
                            <li class="mb-2">• Use the task list to monitor progress and update status as work advances.</li>
                            <li class="mb-2">• Assign or reassign this task to a colleague if priorities change.</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-column flex-md-row gap-2 justify-content-center">
                    <a class="btn btn-primary" href="{{ route('tasks.show', $task) }}">View Task</a>
                    <a class="btn btn-outline-secondary" href="{{ route('tasks.index') }}">Back to Task List</a>

                    @can('update', $task)
                        <a class="btn btn-outline-info" href="{{ route('tasks.edit', $task) }}">Edit Task</a>
                    @endcan

                    @can('delete', $task)
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete Task</button>
                        </form>
                    @endcan
                </div>

                @unless(auth()->user()->can('update', $task) || auth()->user()->can('delete', $task))
                    <div class="mt-3 text-center text-muted">
                        This task is visible to you for review. Only the creator or an administrator can edit or delete it.
                    </div>
                @endunless
            </div>
        </div>
    </div>
</x-app-layout>
