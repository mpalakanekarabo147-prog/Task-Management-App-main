<x-app-layout>
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card surface-card">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            @if(auth()->user()->avatar_path)
                                <img src="{{ asset(auth()->user()->avatar_path) }}" alt="{{ auth()->user()->name }}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: #FF6B6B;">
                                    <span class="text-white fw-bold" style="font-size: 2rem;">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <h3 class="card-title fw-bold" style="color: #1E3A5F;">{{ auth()->user()->name }}</h3>
                        <p class="text-muted mb-3">{{ auth()->user()->email }}</p>

                        <div class="mb-4">
                            <span class="badge" style="background-color: #1E3A5F; font-size: 0.875rem; padding: 0.5rem 1rem;">
                                {{ auth()->user()->role_label }}
                            </span>
                        </div>

                        <a href="{{ route('notifications.settings') }}" class="btn btn-outline-primary w-100 mb-2" style="color: #1E3A5F; border-color: #1E3A5F;">
                            <i class="bi bi-bell me-2"></i>Notification Settings
                        </a>
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-list-check me-2"></i>View My Tasks
                        </a>
                    </div>
                </div>

                <div class="card surface-card mt-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-4" style="color: #1E3A5F;">Your Activity</h5>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Tasks Created</span>
                            <span class="badge bg-light text-dark fw-bold">{{ $tasksCreated }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Assigned to You</span>
                            <span class="badge bg-light text-dark fw-bold">{{ $tasksAssigned }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Completed</span>
                            <span class="badge" style="background-color: #10b981;">{{ $completedTasks }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">In Progress</span>
                            <span class="badge" style="background-color: #f59e0b;">{{ $inProgressTasks }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card surface-card mb-4">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="card-title fw-bold mb-0" style="color: #1E3A5F;">
                            <i class="bi bi-person me-2"></i>Profile Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-600">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-600">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 mt-3">
                                <label for="avatar" class="form-label fw-600">Profile Picture</label>
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                                <small class="text-muted d-block mt-2">Supported formats: JPG, PNG, GIF (Max 2MB)</small>
                                @error('avatar')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" style="background-color: #1E3A5F; border-color: #1E3A5F;">
                                <i class="bi bi-check-circle me-2"></i>Save Profile
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card surface-card mb-4">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="card-title fw-bold mb-0" style="color: #1E3A5F;">
                            <i class="bi bi-key me-2"></i>Change Password
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-600">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-600">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-600">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-secondary mt-3" style="background-color: #1E3A5F; border-color: #1E3A5F; color: #fff;">
                                <i class="bi bi-lock-fill me-2"></i>Update Password
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card surface-card p-4">
                            <h6 class="text-muted mb-3">Due Today</h6>
                            <p class="mb-0">{{ $dueTodayTasks->count() }} tasks due today</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card surface-card p-4">
                            <h6 class="text-muted mb-3">Due This Week</h6>
                            <p class="mb-0">{{ $dueThisWeekTasks->count() }} tasks due this week</p>
                        </div>
                    </div>
                </div>

                <div class="card surface-card mt-4">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="card-title fw-bold mb-0" style="color: #1E3A5F;">
                            <i class="bi bi-grid-3x3-gap me-2"></i>Task Summary by Category
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($tasksByCategory->isNotEmpty())
                            <ul class="list-group list-group-flush">
                                @foreach($tasksByCategory as $category => $group)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                        <span>{{ $category }}</span>
                                        <span class="badge bg-light text-dark">{{ $group->count() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">No task categories available yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
