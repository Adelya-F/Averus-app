<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Averus - Bimbel Kreatif</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
    padding-top:50px;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 w-full shadow bg-gradient-to-r from-blue-300 to-indigo-500">

<div class="flex items-center gap-3 px-4 py-2">

<!-- tombol back -->
<a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('siswa.dashboard') }}"
   class="flex items-center justify-center w-10 h-10 bg-white border border-gray-200 text-gray-600 rounded-xl shadow hover:bg-blue-100 transition">
   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
   </svg>
</a>
<!-- logo + tulisan -->
<a href="/" class="flex items-center gap-2 no-underline">

<img src="{{ asset('image/averus.png') }}"
alt="Logo Averus"
class="h-10 w-auto">

<h1 class="text-xl md:text-2xl font-bold flex mb-0">
<span class="text-red-500">A</span>
<span class="text-yellow-500">v</span>
<span class="text-green-500">e</span>
<span class="text-blue-500">r</span>
<span class="text-purple-500">u</span>
<span class="text-pink-500">s</span>
</h1>

</a>

</div>
</nav>


<!-- ISI -->

<main>
@yield('content')
</main>

<!-- FOOTER -->
<section class="py-10 bg-gradient-to-r from-yellow-300 to-amber-100 text-center mt-auto">

<footer class="text-amber-900 font-medium">
&copy; 2026 Averus. Semua hak cipta dilindungi.
</footer>

</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>