<x-app-layout title="Login">
    <div class="row justify-content-center align-items-center g-4">
        <div class="col-md-6">
            <div class="hero-panel p-4 p-lg-5" style="--hero-image: url('{{ asset('images/Background.jpg') }}')">
                <div class="content">
                    <div class="hero-kicker mb-2">TaskFlow</div>
                    <h1 class="h2 fw-bold">Built for tech teams that move fast.</h1>
                    <p class="mb-3">TaskFlow is a task management platform designed for technology teams. Assign, track, and deliver work across web development, mobile, cybersecurity, AI, databases, design, and networking — all in one place.</p>
                    <p class="mb-0">Stay on top of deadlines, priorities, and team progress so nothing falls through the cracks.</p>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card surface-card">
                <div class="card-body p-4">
                    <h1 class="h4 mb-3">Login to TaskFlow</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="remember" name="remember" type="checkbox">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button class="btn btn-primary w-100">Login</button>
                    </form>
                    <p class="mt-3 mb-0">Need an account? <a href="{{ route('register') }}">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
