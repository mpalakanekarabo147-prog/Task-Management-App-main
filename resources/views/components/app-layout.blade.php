<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'TaskFlow' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --smart-navy: #1E3A5F;
            --smart-coral: #FF6B6B;
            --smart-silver: #D3D3D3;
            --smart-ink: #152238;
        }
        body { background: #f3f5f8; color: #1f2937; }
        .shell { max-width: 1180px; }
        .navbar { border-top: 4px solid var(--smart-coral); box-shadow: 0 12px 28px rgba(30, 58, 95, .08); }
        .nav-brand { color: var(--smart-navy) !important; font-weight: 800; letter-spacing: .02em; }
        .nav-link { font-weight: 600; color: #42526b; }
        .nav-link:hover { color: var(--smart-coral); }
        .metric { border: 0; border-left: 4px solid var(--smart-coral); min-height: 112px; }
        .btn-primary {
            --bs-btn-bg: var(--smart-navy);
            --bs-btn-border-color: var(--smart-navy);
            --bs-btn-hover-bg: #172d49;
            --bs-btn-hover-border-color: #172d49;
        }
        .btn-outline-primary {
            --bs-btn-color: var(--smart-navy);
            --bs-btn-border-color: var(--smart-navy);
            --bs-btn-hover-bg: var(--smart-navy);
            --bs-btn-hover-border-color: var(--smart-navy);
        }
        a { color: var(--smart-navy); }
        a:hover { color: var(--smart-coral); }
        .card { border-radius: 8px; }
        .surface-card { border: 0; box-shadow: 0 18px 45px rgba(30, 58, 95, .09); }
        .hero-panel {
            position: relative;
            overflow: hidden;
            min-height: 320px;
            border-radius: 8px;
            background: linear-gradient(90deg, rgba(21, 34, 56, .94), rgba(30, 58, 95, .7)), var(--hero-image);
            background-size: cover;
            background-position: center;
            color: #fff;
            box-shadow: 0 24px 60px rgba(21, 34, 56, .22);
        }
        .hero-panel .content { max-width: 640px; }
        .hero-kicker { color: var(--smart-coral); font-weight: 800; letter-spacing: .08em; text-transform: uppercase; font-size: .75rem; }
        .vehicle-card { overflow: hidden; border: 0; box-shadow: 0 14px 34px rgba(30, 58, 95, .1); }
        .vehicle-card img { width: 100%; height: 168px; object-fit: cover; display: block; }
        .vehicle-card .badge { background: var(--smart-navy); }
        .table thead th { color: #627084; font-size: .78rem; text-transform: uppercase; letter-spacing: .04em; }
        .priority-high { color: #c2410c; }
        .priority-medium { color: #b54708; }
        .priority-low { color: var(--smart-navy); }
        .status-pill { text-transform: capitalize; }
        .badge.text-bg-light { background: var(--smart-silver) !important; color: var(--smart-navy) !important; }
    </style>
</head>
<body>
    <x-navigation />

    <main class="container shell py-4">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
