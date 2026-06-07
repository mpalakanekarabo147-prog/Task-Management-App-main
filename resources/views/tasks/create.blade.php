<x-app-layout title="New Task">
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h1 class="h3 fw-bold mb-2" style="color: #1E3A5F;">New Task</h1>
                <p class="text-muted mb-0">Capture the task details and assign responsibility so your team can move forward with confidence.</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Tasks
            </a>
        </div>

        <div class="card surface-card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @include('tasks._form', ['buttonText' => 'Save Task'])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
