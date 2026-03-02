<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Averus course</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

<!-- NAVIGATION -->
<nav class="bg-white shadow-md fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-600">Averus Lesson</h1>
        

        <div class="space-x-6 hidden md:flex">
            <a href="#" class="hover:text-blue-600">Dashboard</a>
            <a href="#program" class="hover:text-blue-600">Program</a>
            <a href="#fasilitas" class="hover:text-blue-600">Fasilitas</a>
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold">Daftar</a>
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Login</a>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="pt-32 pb-20 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                Tingkatkan Prestasimu Bersama Kami
            </h2>
            <p class="mt-6 text-lg">
                Tempat kursus terbaik untuk SD, SMP, dan SMA.
                Mentor berpengalaman dan metode belajar interaktif.
            </p>
            <div class="mt-8">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                    Daftar Sekarang
                </a>
            </div>
        </div>

        <div>
            <img src="https://images.unsplash.com/photo-1584697964358-3e14ca57658b"
                 class="rounded-xl shadow-2xl"
                 alt="Kursus">
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h3 class="text-3xl font-bold mb-6">Kenapa Memilih Kami?</h3>
        <p class="text-gray-600 max-w-3xl mx-auto">
            Kami berkomitmen membantu siswa memahami pelajaran dengan metode
            yang menyenangkan dan efektif.
        </p>

        <div class="grid md:grid-cols-3 gap-10 mt-12">
            <div class="p-6 bg-gray-50 rounded-xl shadow">
                <h4 class="font-bold text-xl mb-2">Mentor Profesional</h4>
                <p class="text-gray-600">Pengajar berpengalaman & tersertifikasi.</p>
            </div>
            <div class="p-6 bg-gray-50 rounded-xl shadow">
                <h4 class="font-bold text-xl mb-2">Kelas Interaktif</h4>
                <p class="text-gray-600">Belajar aktif & tidak membosankan.</p>
            </div>
            <div class="p-6 bg-gray-50 rounded-xl shadow">
                <h4 class="font-bold text-xl mb-2">Laporan Berkala</h4>
                <p class="text-gray-600">Orang tua bisa memantau perkembangan.</p>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAM -->
<section id="program" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-center mb-12">Program Kelas</h3>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="font-bold text-xl mb-3">Kelas SD</h4>
                <p class="text-gray-600 mb-4">Fokus Matematika & Bahasa Indonesia.</p>
                <p class="font-semibold text-blue-600">Rp 350.000 / bulan</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="font-bold text-xl mb-3">Kelas SMP</h4>
                <p class="text-gray-600 mb-4">Matematika, IPA & Bahasa Inggris.</p>
                <p class="font-semibold text-blue-600">Rp 450.000 / bulan</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h4 class="font-bold text-xl mb-3">Kelas SMA</h4>
                <p class="text-gray-600 mb-4">Persiapan UTBK & Olimpiade.</p>
                <p class="font-semibold text-blue-600">Rp 600.000 / bulan</p>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONI -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h3 class="text-3xl font-bold mb-12">Testimoni Siswa</h3>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-6 rounded-xl shadow">
                <p>"Nilai matematika saya naik drastis!"</p>
                <p class="mt-4 font-semibold">- Andi (SMP)</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl shadow">
                <p>"Pengajarnya sabar dan mudah dipahami."</p>
                <p class="mt-4 font-semibold">- Siti (SMA)</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl shadow">
                <p>"Tempat kursus terbaik di kota ini."</p>
                <p class="mt-4 font-semibold">- Orang Tua Murid</p>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h4 class="text-xl font-bold mb-4">Kursus Cerdas Nusantara</h4>
        <p class="text-gray-400">Jl. Pendidikan No. 123, Indonesia</p>
        <p class="text-gray-400 mt-2">© 2026 All Rights Reserved</p>
    </div>
</footer>

</body>
</html>
