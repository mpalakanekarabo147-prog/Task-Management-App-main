<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server error | TaskFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center">
        <section class="text-center">
            <p class="text-uppercase text-muted fw-semibold mb-2">500</p>
            <h1 class="display-6 fw-bold">Something went wrong</h1>
            <p class="lead text-muted">Please try again. If the problem continues, contact the system administrator.</p>
            <a class="btn btn-primary" href="{{ url('/') }}">Go home</a>
        </section>
    </main>
</body>
</html>
