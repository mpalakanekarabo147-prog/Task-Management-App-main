<x-app-layout title="Categories">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Categories</h1>
            <p class="text-muted mb-0">Organize task workstreams and quick-filter task lists by category.</p>
        </div>
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Browse Tasks</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card surface-card">
                <div class="card-body">
                    <h2 class="h5">Create a category</h2>
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="color">Color</label>
                            <input class="form-control form-control-color" id="color" name="color" type="color" value="#0d6efd">
                        </div>
                        <button class="btn btn-primary">Save category</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card surface-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Tasks</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <span class="badge me-2" style="background: {{ $category->color }}; width: 14px; height: 14px; display: inline-block;"></span>
                                    {{ $category->name }}
                                </td>
                                <td>{{ $category->tasks_count }}</td>
                                <td class="text-end">
                                    <a href="{{ route('tasks.index', ['category_id' => $category->id]) }}" class="btn btn-sm btn-outline-primary me-2">
                                        View tasks
                                    </a>
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">No categories yet. Add one to keep tasks organized.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
