<x-app-layout>
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="color: #1E3A5F;">
                    <i class="bi bi-check2-all me-2"></i>Assigned Tasks
                </h2>
                <p class="text-muted mb-0">Track tasks currently assigned to you with filters and fast access.</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">View all tasks</a>
        </div>

        <form method="GET" action="{{ route('tasks.assigned') }}" class="row g-3 mb-4">
            <div class="col-md-5">
                <label class="form-label">Search assigned tasks</label>
                <input name="search" type="search" class="form-control" placeholder="Search title or description" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                    <option value="in_progress" @selected(request('status') === 'in_progress')>In Progress</option>
                    <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                </select>
            </div>
            <div class="col-md-2 text-end align-self-end">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('tasks.assigned') }}" class="btn btn-link">Reset</a>
            </div>
        </form>

        <div class="d-flex gap-2 mb-4 flex-wrap">
            <a href="{{ route('tasks.assigned', array_merge(request()->except('page'), ['status' => 'pending'])) }}" class="btn {{ request('status') === 'pending' ? 'btn-primary' : 'btn-outline-secondary' }}" 
                style="{{ request('status') === 'pending' ? 'background-color: #1E3A5F; border-color: #1E3A5F;' : 'color: #1E3A5F; border-color: #1E3A5F;' }}">
                <i class="bi bi-hourglass-split me-1"></i>Pending
            </a>
            <a href="{{ route('tasks.assigned', array_merge(request()->except('page'), ['status' => 'in_progress'])) }}" class="btn {{ request('status') === 'in_progress' ? 'btn-primary' : 'btn-outline-secondary' }}" 
                style="{{ request('status') === 'in_progress' ? 'background-color: #1E3A5F; border-color: #1E3A5F;' : 'color: #1E3A5F; border-color: #1E3A5F;' }}">
                <i class="bi bi-arrow-repeat me-1"></i>In Progress
            </a>
            <a href="{{ route('tasks.assigned', array_merge(request()->except('page'), ['status' => 'completed'])) }}" class="btn {{ request('status') === 'completed' ? 'btn-primary' : 'btn-outline-secondary' }}" 
                style="{{ request('status') === 'completed' ? 'background-color: #1E3A5F; border-color: #1E3A5F;' : 'color: #1E3A5F; border-color: #1E3A5F;' }}">
                <i class="bi bi-check-circle me-1"></i>Completed
            </a>
        </div>

        @if($tasks->count() > 0)
            <div class="row g-3">
                @foreach($tasks as $task)
                    <div class="col-lg-6">
                        <div class="card surface-card h-100 task-card" style="border-left: 4px solid 
                            @if($task->priority === 'high') #dc2626 
                            @elseif($task->priority === 'medium') #f59e0b 
                            @else #06b6d4 
                            @endif;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title fw-bold mb-1" style="color: #1E3A5F;">{{ $task->title }}</h5>
                                        <p class="text-muted small mb-3">{{ optional($task->category)->name ?? 'Uncategorized' }}</p>
                                    </div>
                                    @if($task->status === 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($task->status === 'in_progress')
                                        <span class="badge bg-warning">In Progress</span>
                                    @else
                                        <span class="badge bg-secondary">Pending</span>
                                    @endif
                                </div>

                                @if($task->description)
                                    <p class="card-text text-muted small mb-3">{{ Str::limit($task->description, 80) }}</p>
                                @endif

                                @if($task->tags)
                                    <div class="mb-3">
                                        @foreach($task->tags as $tag)
                                            <span class="badge bg-secondary text-white small me-1 mb-1">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                    <div class="small">
                                        @if($task->deadline)
                                            <div class="mb-2">
                                                <i class="bi bi-calendar me-2" style="color: #FF6B6B;"></i>
                                                <span class="text-muted">{{ $task->deadline->format('M d, Y') }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <i class="bi bi-flag me-2"></i>
                                            <span class="badge 
                                                @if($task->priority === 'high') bg-danger 
                                                @elseif($task->priority === 'medium') bg-warning 
                                                @else bg-info @endif">
                                                {{ ucfirst($task->priority) }} Priority
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-outline-primary flex-grow-1" style="color: #1E3A5F; border-color: #1E3A5F;">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary" style="color: #1E3A5F; border-color: #1E3A5F;">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $tasks->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="card surface-card text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                <h5 class="text-muted mb-2">No tasks assigned to you</h5>
                <p class="text-muted">You don't have any tasks assigned at the moment.</p>
            </div>
        @endif
    </div>

    <style>
        .task-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(30, 58, 95, 0.15) !important;
        }
    </style>
</x-app-layout>
