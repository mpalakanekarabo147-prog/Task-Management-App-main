<x-app-layout title="TaskFlow">
    <div class="row align-items-center py-5">
        <div class="col-lg-6">
            <div class="hero-panel" style="--hero-image: url('{{ asset('images/Background.jpg') }}')">
                <div class="content p-5 p-lg-6">
                    <div class="hero-kicker mb-3">Technology Operations</div>
                    <h1 class="display-6 fw-bold mb-3">Build smarter workflows for your tech teams.</h1>
                    <p class="lead text-white mb-4">TaskFlow brings task management, team coordination, and delivery tracking together for modern technology organizations.</p>
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-outline-light btn-lg" href="{{ route('register') }}">Create Account</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card surface-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-bar-chart-line fs-2 text-primary me-3"></i>
                            <div>
                                <h5 class="mb-1">Operational visibility</h5>
                                <p class="text-muted mb-0">Track project progress, sprint status, and team capacity in one place.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card surface-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-gear fs-2 text-primary me-3"></i>
                            <div>
                                <h5 class="mb-1">Tech-friendly task flow</h5>
                                <p class="text-muted mb-0">Organize work by category, priority, and delivery deadline with engineering teams in mind.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card surface-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-people fs-2 text-primary me-3"></i>
                            <div>
                                <h5 class="mb-1">Team collaboration</h5>
                                <p class="text-muted mb-0">Assign tasks, monitor progress, and keep every stakeholder aligned.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card surface-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-bell fs-2 text-primary me-3"></i>
                            <div>
                                <h5 class="mb-1">Deadline alerts</h5>
                                <p class="text-muted mb-0">Stay ahead of milestones and ship features on time with proactive reminders.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4 mt-4">
        <div class="col-lg-4">
            <div class="card surface-card p-4">
                <h5 class="mb-3">Designed for tech teams</h5>
                <p class="text-muted">Keep every sprint, bug fix, and release task well organized with a platform built for development and operations work.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card surface-card p-4">
                <h5 class="mb-3">Category-driven clarity</h5>
                <p class="text-muted">Group tasks by service, feature, or incident to keep priorities visible and manageable.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card surface-card p-4">
                <h5 class="mb-3">Built for fast delivery</h5>
                <p class="text-muted">Make every task count with workflows that support engineering velocity and quality execution.</p>
            </div>
        </div>
    </div>
</x-app-layout>
