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

        .navbar-logo-img{
            max-height:45px;
            width:auto;
            margin-right:12px;
        }
    </style>
</head>

<body>

<nav class="navbar fixed-top shadow-sm bg-gradient-to-r from-blue-300 to-indigo-500 w-full">
    <div class="container flex items-center justify-between">

        <!-- LOGO -->
        <a class="flex items-center" href="/">
            <img src="{{ asset('image/averus.png') }}" class="navbar-logo-img" alt="Logo Averus">

            <h1 class="text-xl md:text-2xl font-bold flex mb-0">
                <span class="text-red-500">A</span>
                <span class="text-yellow-500">v</span>
                <span class="text-green-500">e</span>
                <span class="text-blue-500">r</span>
                <span class="text-purple-500">u</span>
                <span class="text-pink-500">s</span>
            </h1>
        </a>

        <!-- RIGHT MENU -->
        <div class="flex items-center gap-3">

            <!-- BACK BUTTON -->
            <a href="{{ route('admin.dashboard') }}"
               class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow hover:bg-blue-50 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-gray-700"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>

            </a>

            <!-- LOGOUT -->
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-white font-medium hover:opacity-80">
                    Logout
                </button>
            </form>
            @endauth

        </div>

    </div>
</nav>

{{-- CONTENT --}}
<main>
    @yield('content')
</main>

<section class="py-10 bg-gradient-to-r from-yellow-300 to-amber-100 w-full text-center mt-auto">
    <div class="container">
        <footer class="text-amber-900 font-medium">
            © 2026 Averus. Semua hak cipta dilindungi.
        </footer>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>