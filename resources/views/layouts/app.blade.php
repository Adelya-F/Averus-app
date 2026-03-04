<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Averus - Bimbel Kreatif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { padding-top: 80px; }
        .nav-link { color: white !important; font-weight: 500; }
        .nav-link:hover { opacity: 0.8; }
        
        .navbar-logo-img {
            max-height: 45px;
            width: auto;
            margin-right: 12px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand fixed-top shadow-sm bg-gradient-to-r from-blue-300 to-indigo-500 text-white w-full">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('image/averus.png') }}" alt="Logo Averus" class="navbar-logo-img">
            <h1 class="text-xl md:text-2xl font-bold flex mb-0">
                <span class="text-red-500">A</span>
                <span class="text-yellow-500">v</span>
                <span class="text-green-500">e</span>
                <span class="text-blue-500">r</span>
                <span class="text-purple-500">u</span>
                <span class="text-pink-500">s</span>
            </h1>
        </a>

        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item me-3">
                <a class="nav-link" href="javascript:history.back()">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </li>

            @auth
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link p-0" style="border:none; text-decoration: none;">
                        Logout
                    </button>
                </form>
            </li>
            @endauth
        </ul>
    </div>
</nav>

{{-- ISI KONTEN --}}
<main>
    @yield('content')
    <main class="py-4">
    {{ $slot }}
</main>
</main>

<section class="py-10 bg-gradient-to-r from-yellow-300 to-amber-100 w-full text-center mt-auto">
    <div class="container">
        <footer class="text-amber-900 font-medium">
            &copy; 2026 Averus. Semua hak cipta dilindungi.
        </footer>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>