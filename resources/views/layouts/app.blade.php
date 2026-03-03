<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Averus - Bimbel Kreatif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="/">Averus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
               <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
               <li class="nav-item"><a class="nav-link" href="#program">Program</a></li>
               <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
               <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
               @auth
<li class="nav-item">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link btn btn-link" style="border:none;">
            Logout
        </button>
    </form>
</li>
@endauth
            </ul>
        </div>
    </div>
</nav>

{{-- ISI KONTEN --}}
@yield('content')

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; 2026 Averus. Semua hak cipta dilindungi.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>