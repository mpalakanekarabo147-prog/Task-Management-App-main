<x-app-layout>
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0" style="color: #1E3A5F;">
                <i class="bi bi-people me-2"></i>Manage Users
            </h2>
        </div>

        <!-- Users Table -->
        @if($users->count() > 0)
            <div class="card surface-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="color: #42526b;">Name</th>
                                <th style="color: #42526b;">Email</th>
                                <th style="color: #42526b;">Role</th>
                                <th style="color: #42526b;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($user->avatar_path)
                                                <img src="{{ asset($user->avatar_path) }}" alt="{{ $user->name }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #FF6B6B; color: white; font-weight: bold;">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <strong>{{ $user->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge" style="background-color: #1E3A5F;">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-primary" style="color: #1E3A5F; border-color: #1E3A5F;">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary" style="color: #1E3A5F; border-color: #1E3A5F;">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if(auth()->user()->id !== $user->id)
                                                <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="card surface-card text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                <h5 class="text-muted mb-2">No users found</h5>
                <p class="text-muted">There are no users in the system yet.</p>
            </div>
        @endif
    </div>
</x-app-layout>
