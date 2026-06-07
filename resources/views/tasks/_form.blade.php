@csrf
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label" for="title">Title</label>
        <input class="form-control" id="title" name="title" value="{{ old('title', $task->title ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="category_id">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $task->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="assigned_to">Assign to</label>
        <select class="form-select" id="assigned_to" name="assigned_to">
            @if(auth()->user()->isAdmin())
                <option value="">Unassigned</option>
            @endif
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('assigned_to', $task->assigned_to ?? '') == $user->id)>{{ $user->name }} ({{ $user->role_label }})</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="tags">Tags</label>
        <input class="form-control" id="tags" name="tags" value="{{ old('tags', isset($task) ? implode(', ', $task->tags ?? []) : '') }}" placeholder="Enter comma-separated tags">
        <small class="text-muted">Optional tags help you group related work.</small>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="priority">Priority</label>
        <select class="form-select" id="priority" name="priority" required>
            @foreach(['low', 'medium', 'high'] as $priority)
                <option value="{{ $priority }}" @selected(old('priority', $task->priority ?? 'medium') === $priority)>{{ ucfirst($priority) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="status">Status</label>
        <select class="form-select" id="status" name="status" required>
            @foreach(['pending' => 'Pending', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $task->status ?? 'pending') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label" for="deadline">Deadline</label>
        <input class="form-control" id="deadline" name="deadline" type="date" value="{{ old('deadline', isset($task) && $task->deadline ? $task->deadline->format('Y-m-d') : '') }}">
    </div>
    <div class="col-12">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $task->description ?? '') }}</textarea>
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button class="btn btn-primary">{{ $buttonText }}</button>
    <a class="btn btn-outline-secondary" href="{{ route('tasks.index') }}">Cancel</a>
</div>
