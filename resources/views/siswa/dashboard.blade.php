<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-700 text-white hidden md:block">
        <div class="p-6 text-2xl font-bold border-b border-blue-500">
            Siswa Panel
        </div>

        <nav class="p-4 space-y-3">
            <a href="{{ route('siswa.dashboard') }}" class="block p-3 rounded-lg hover:bg-blue-600">Dashboard</a>
            <a href="{{ route('siswa.absen') }}" class="block p-3 rounded-lg hover:bg-blue-600">Absen</a>
            <a href="{{ route('siswa.jadwal') }}" class="block p-3 rounded-lg hover:bg-blue-600">Jadwal</a>
            <a href="{{ route('profile.edit') }}" class="block p-3 rounded-lg hover:bg-blue-600">Edit Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left p-3 rounded-lg hover:bg-red-600 mt-6">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Halo, {{ Auth::user()->name }} 👋
            </h1>
            <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm">
                Aktif
            </span>
        </div>

        <!-- STAT CARDS -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500">Total Kehadiran</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">24</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500">Tidak Hadir</h3>
                <p class="text-3xl font-bold text-red-500 mt-2">2</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500">Kelas Aktif</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-2">3</p>
            </div>

        </div>

        <!-- JADWAL HARI INI -->
        <div class="bg-white p-6 rounded-xl shadow mb-8">
            <h2 class="text-xl font-bold mb-4">Jadwal Hari Ini</h2>

            <div class="space-y-4">

                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold">Matematika</p>
                        <p class="text-sm text-gray-500">16:00 - 17:30</p>
                    </div>
                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm">
                        Ruang A
                    </span>
                </div>

                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold">Bahasa Inggris</p>
                        <p class="text-sm text-gray-500">18:00 - 19:30</p>
                    </div>
                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm">
                        Ruang B
                    </span>
                </div>

            </div>
        </div>

        <!-- ABSEN BUTTON -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 rounded-xl text-white flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold">Absen Kehadiran Hari Ini</h3>
                <p class="text-sm opacity-90">Pastikan kamu melakukan absensi sebelum kelas dimulai</p>
            </div>

            <a href="{{ route('siswa.absen') }}"
               class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
               Absen Sekarang
            </a>
        </div>

    </main>
</div>

</body>
</html>