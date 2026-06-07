<x-app-layout>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card surface-card">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="card-title fw-bold mb-0" style="color: #1E3A5F;">
                            <i class="bi bi-pencil-square me-2"></i>Edit User
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-600" style="color: #1E3A5F;">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-600" style="color: #1E3A5F;">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(auth()->user()->role === 'admin')
                                <!-- Role -->
                                <div class="mb-4">
                                    <label for="role" class="form-label fw-600" style="color: #1E3A5F;">User Role</label>
                                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                        <option value="">Select a role</option>
                                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                                        <option value="team_member" @selected(old('role', $user->role) === 'team_member')>Team Member</option>
                                        <option value="guest" @selected(old('role', $user->role) === 'guest')>Guest</option>
                                    </select>
                                    <small class="text-muted d-block mt-2">
                                        <strong>Admin:</strong> Full access to all features<br>
                                        <strong>Team Member:</strong> Can create and manage tasks<br>
                                        <strong>Guest:</strong> Limited to assigned tasks only
                                    </small>
                                    @error('role')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                <div class="mb-4">
                                    <label class="form-label fw-600" style="color: #1E3A5F;">User Role</label>
                                    <div class="form-control-plaintext">{{ $user->role_label }}</div>
                                </div>
                            @endif

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary" style="background-color: #1E3A5F; border-color: #1E3A5F;">
                                    <i class="bi bi-check-circle me-2"></i>Save Changes
                                </button>
                                <a href="{{ route('users.show', $user) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
