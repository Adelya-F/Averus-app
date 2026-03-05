<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengajar - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-blue-500 text-white hidden md:flex md:flex-col">

    <div class="p-6 text-2xl font-bold border-b border-blue-700">
        Averus Pengajar
    </div>

    <nav class="flex-1 p-4 space-y-3">

        <a href="{{ route('pengajar.dashboard') }}"
           class="block px-4 py-2 rounded-lg bg-blue-700 font-semibold">
            Dashboard
        </a>

        <a href="#"
           class="block px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Jadwal Mengajar
        </a>

        <a href="#"
           class="block px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Laporan
        </a>

    </nav>

    <div class="p-4 border-t border-blue-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg font-semibold">
                Logout
            </button>
        </form>
    </div>

</aside>

<!-- CONTENT -->
<div class="flex-1 flex flex-col">

    <!-- HEADER -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold text-gray-700">
        Dashboard Pengajar
    </h1>

    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 hover:bg-gray-50 p-2 rounded-lg transition group">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-semibold text-gray-700 group-hover:text-blue-600">
                {{ Auth::user()->name }}
            </p>
            <p class="text-xs text-gray-500 uppercase">
                {{ Auth::user()->role }}
            </p>
        </div>

        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold shadow-sm overflow-hidden">
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/avatars/'.Auth()->user()->avatar) }}" class="w-full h-full object-cover">
            @else
                {{ strtoupper(substr(Auth()->user()->name,0,1)) }}
            @endif
        </div>
    </a>
    </header>

    <!-- MAIN -->
    <main class="p-6 flex-1">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-xl shadow border-b-4 border-blue-500">
                <h3 class="text-gray-500 text-sm">Total Siswa Aktif</h3>
                <p class="text-3xl font-bold text-blue-700 mt-2">
                    {{ $totalSiswa }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border-b-4 border-green-500">
                <h3 class="text-gray-500 text-sm">Total Kelas</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">
                    {{ $totalKelas }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border-b-4 border-yellow-400">
                <h3 class="text-gray-500 text-sm">Jadwal Hari Ini</h3>
                <p class="text-3xl font-bold text-yellow-500 mt-2">
                    {{ $jadwalHariIni }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border-b-4 border-red-500">
                <h3 class="text-gray-500 text-sm">Pesan Baru</h3>
                <p class="text-3xl font-bold text-red-500 mt-2">
                    {{ $unreadCount }}
                </p>
            </div>

        </div>

        <!-- INFO BOX -->
        <div class="mt-8 bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Selamat Datang 👋
            </h3>

            <p class="text-gray-600 text-sm">
                Ini adalah dashboard pengajar.  
                Anda dapat melihat ringkasan aktivitas mengajar di sini.
            </p>
        </div>

    </main>

</div>

</body>
</html>