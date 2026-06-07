<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top" style="border-top: 4px solid #FF6B6B; box-shadow: 0 12px 28px rgba(30, 58, 95, 0.08);">
    <div class="container-fluid ps-4 pe-4">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}" style="color: #1E3A5F; letter-spacing: 0.02em; font-size: 1.3rem;">
            <i class="bi bi-cpu me-2"></i>TaskFlow
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-600 {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" style="color: #42526b;">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-600 {{ request()->routeIs('tasks.index') || request()->routeIs('tasks.assigned') ? 'active' : '' }}" href="{{ route('tasks.index') }}" style="color: #42526b;">
                            <i class="bi bi-list-check me-1"></i>My Tasks
                        </a>
                    </li>
                    @can('viewAny', App\Models\CategoryKAL::class)
                        <li class="nav-item">
                            <a class="nav-link fw-600 {{ request()->routeIs('categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}" style="color: #42526b;">
                                <i class="bi bi-tag me-1"></i>Categories
                            </a>
                        </li>
                    @endcan
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link fw-600 {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}" style="color: #42526b;">
                                <i class="bi bi-people me-1"></i>Manage Users
                            </a>
                        </li>
                    @endif
                </ul>

                <div class="d-flex align-items-center ms-auto">
                    @can('create', App\Models\TaskKAL::class)
                        <a class="btn btn-sm btn-primary me-3" href="{{ route('tasks.create') }}" style="background-color: #1E3A5F; border-color: #1E3A5F;">
                            <i class="bi bi-plus-circle me-1"></i>Create Task
                        </a>
                    @endcan
                    <div class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-600 d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #42526b;">
                                <i class="bi bi-person-circle me-2" style="font-size: 1.3rem;"></i>
                                <div>
                                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                                    <small class="d-none d-md-inline text-muted ms-1">{{ auth()->user()->role_label }}</small>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="min-width: 240px;">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('tasks.assigned') }}">
                                        <i class="bi bi-check2-all me-2"></i>My Assigned Tasks
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('notifications.settings') }}">
                                        <i class="bi bi-bell me-2"></i>Notification Settings
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-600" href="{{ route('login') }}" style="color: #42526b;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm ms-2" href="{{ route('register') }}" style="background-color: #1E3A5F; border-color: #1E3A5F;">Register</a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

<style>
    .navbar-nav .nav-link.active { color: #1E3A5F !important; font-weight: 700; }
    .navbar-nav .nav-link:hover { color: #FF6B6B !important; transition: color 0.3s ease; }
    .navbar-nav .dropdown-item:hover { color: #FF6B6B; background-color: #f8f9fa; }
    .navbar-nav .dropdown-item.text-danger:hover { background-color: #ffe5e5; }
    .navbar-toggler:focus { box-shadow: 0 0 0 0.25rem rgba(30, 58, 95, 0.25); }
    @media (max-width: 991px) {
        .navbar-collapse { margin-top: 1rem; border-top: 1px solid #e5e7eb; padding-top: 1rem; }
        .nav-item { margin-bottom: 0.5rem; }
        .navbar-nav .dropdown-menu { position: static; float: none; width: 100%; margin-top: 0.5rem; box-shadow: none; border: 1px solid #e5e7eb; }
    }
</style>
