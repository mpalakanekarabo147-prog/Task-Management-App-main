<x-app-layout>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- User Card -->
                <div class="card surface-card mb-4">
                    <div class="card-body text-center p-5">
                        <!-- Avatar -->
                        <div class="mb-4">
                            @if($user->avatar_path)
                                <img src="{{ asset($user->avatar_path) }}" alt="{{ $user->name }}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: #FF6B6B;">
                                    <span class="text-white fw-bold" style="font-size: 2rem;">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <h3 class="card-title fw-bold" style="color: #1E3A5F;">{{ $user->name }}</h3>
                        <p class="text-muted mb-3">{{ $user->email }}</p>

                        <!-- Role Badge -->
                        <div class="mb-4">
                            <span class="badge" style="background-color: #1E3A5F; font-size: 0.875rem; padding: 0.5rem 1rem;">
                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                            </span>
                        </div>

                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary" style="background-color: #1E3A5F; border-color: #1E3A5F;">
                                <i class="bi bi-pencil me-2"></i>Edit User
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Details -->
                <div class="card surface-card">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="card-title fw-bold mb-0" style="color: #1E3A5F;">
                            <i class="bi bi-info-circle me-2"></i>User Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Full Name</label>
                                <p class="fw-600" style="color: #1E3A5F;">{{ $user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Email Address</label>
                                <p class="fw-600" style="color: #1E3A5F;">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">User Role</label>
                                <p class="fw-600" style="color: #1E3A5F;">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Member Since</label>
                                <p class="fw-600" style="color: #1E3A5F;">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
