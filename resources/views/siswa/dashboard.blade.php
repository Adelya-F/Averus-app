<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex">

    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-blue-400 text-white 
               transform -translate-x-full transition-transform duration-300 ease-in-out
               md:relative md:translate-x-0 md:flex md:flex-col shadow-xl">
    
            <div class="p-6 text-2xl font-bold border-b border-blue-700 flex justify-between items-center drop-shadow-md">
            <div>
                <span class="text-red-500">A</span>
                <span class="text-yellow-500">v</span>
                <span class="text-green-400">e</span>
                <span class="text-blue-500">r</span>
                <span class="text-purple-500">u</span>
                <span class="text-pink-500">s</span>
                Siswa
            </div>
            <button id="closeSidebar" class="md:hidden text-white focus:outline-none">
                <span class="text-2xl">✕</span>
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-3">
            <a href="{{ route('siswa.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-2 rounded-lg bg-blue-700 font-semibold shadow-inner">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
               </svg>
               Dashboard
            </a>

            <a href="{{ route('siswa.absen') }}" 
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
               </svg>
               Absen
            </a>

            <a href="{{ route('siswa.jadwal') }}" 
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7H3v11a2 2 0 002 2z" />
               </svg>
               Jadwal
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
               </svg>
               Edit Profile
            </a>
        </nav>

        <div class="p-4 border-t border-blue-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg transition font-semibold shadow-md text-white">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

    <div class="flex-1 flex flex-col">
        <header class="bg-[#faf6ef] shadow p-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button id="openSidebar" class="text-blue-600 text-2xl md:hidden focus:outline-none">☰</button>
                <h1 class="text-xl font-semibold text-gray-700">Dashboard Siswa</h1>
            </div>

            <a href="{{ route('profile.edit') }}" 
                class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-xl transition-all duration-200">
                <span class="text-sm text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </a>
        </header>

        <main class="p-6 flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow border-b-4 border-blue-500 hover:scale-105 transition transform">
                    <h3 class="text-gray-500 text-sm font-medium">Total Kehadiran</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalKehadiran }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow border-b-4 border-red-500 hover:scale-105 transition transform">
                    <h3 class="text-gray-500 text-sm font-medium">Tidak Hadir</h3>
                    <p class="text-3xl font-bold text-red-500 mt-2">{{ $totalTidakHadir }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow border-b-4 border-yellow-300 hover:scale-105 transition transform">
                    <h3 class="text-gray-500 text-sm font-medium">Kelas Aktif</h3>
                    <p class="text-3xl font-bold text-yellow-300 mt-2">{{ $kelasAktif }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow border-b-4 border-green-500 hover:scale-105 transition transform">
                    <h3 class="text-gray-500 text-sm font-medium">Status</h3>
                    <p class="text-3xl font-bold text-green-500 mt-2">Aktif</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow mb-8">
                <h2 class="text-xl font-bold mb-4">Jadwal Hari Ini</h2>
                <div class="space-y-4">
                    @forelse($jadwalHariIni as $jadwal)
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold">{{ $jadwal->mata_pelajaran }}</p>
                            <p class="text-sm text-gray-500">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                        </div>
                        <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm">
                            {{ $jadwal->ruang }}
                        </span>
                    </div>
                    @empty
                    <p class="text-gray-400 italic">Tidak ada jadwal hari ini.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 rounded-xl text-white flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold">Absen Kehadiran Hari Ini</h3>
                    <p class="text-sm opacity-90">Pastikan kamu melakukan absensi sebelum kelas dimulai</p>
                </div>
                <a href="{{ route('siswa.absen') }}"
                   class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-md">
                   Absen Sekarang
                </a>
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        };

        openBtn.addEventListener('click', toggleSidebar);
        closeBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>