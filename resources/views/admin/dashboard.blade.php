<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Averus</title>
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
                Admin
            </div>
            <button id="closeSidebar" class="md:hidden text-white focus:outline-none">
                <span class="text-2xl">✕</span>
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-3">
            <a href="{{ route('admin.dashboard') }}" 
   class="flex items-center gap-3 px-4 py-2 rounded-lg bg-blue-700 font-semibold shadow-inner">

    <!-- Icon Dashboard -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h7v7H3V3zm11 0h7v4h-7V3zM3 14h4v7H3v-7zm7 3h11v4H10v-4z"/>
    </svg>

    Dashboard
</a>


<a href="{{ route('admin.pengajar') }}" 
   class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">

    <!-- Icon User -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A9 9 0 1118.88 17.8M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg>

    Data Pengajar
</a>


<a href="#" 
   class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">

    <!-- Icon Calendar -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7H3v11a2 2 0 002 2z"/>
    </svg>

    Jadwal
</a>


<a href="#" 
   class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">

    <!-- Icon Report -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 17v-6m4 6V7m4 10V3M5 21h14"/>
    </svg>

    Laporan
</a>


<a href="{{ route('admin.inbox') }}" 

   class="flex justify-between items-center px-4 py-2 rounded-lg hover:bg-blue-700 transition group">

    <div class="flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-5 h-5" 
             fill="none" 
             viewBox="0 0 24 24" 
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0l-3 4H7l-3-4m16 0H4"/>
        </svg>

        <span class="font-medium">Inbox</span>
    </div>

    @if(isset($unreadCount) && $unreadCount > 0)
        <span class="relative flex h-6 w-6">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex items-center justify-center rounded-full h-6 w-6 bg-red-600 text-white text-[10px] font-bold border border-white">
                {{ $unreadCount }}
            </span>
        </span>
    @endif

</a> 

        </nav>

        <div class="p-4 border-t border-blue-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg transition font-semibold shadow-md">
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
                <h1 class="text-xl font-semibold text-gray-700">Dashboard Utama</h1>
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded-xl shadow border-b-4 border-blue-500 hover:scale-105 transition transform">
                    <h3 class="text-gray-500 text-sm font-medium">Total Siswa Aktif</h3>
                    <p class="text-3xl font-bold text-blue-700 mt-2">{{ $totalSiswa }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border-b-4 border-green-500 hover:scale-105 transition transform">
                    <h3 class="text-gray-500 text-sm font-medium">Total Pengajar</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalPengajar }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border-b-4 border-red-500 hover:scale-105 transition transform">
                    <h3 class="text-gray-500 text-sm font-medium text-red-400">Antrean Verifikasi</h3>
                    <p class="text-3xl font-bold text-red-500 mt-2">{{ $pendingSiswa }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border-b-4 border-yellow-400 hover:scale-105 transition transform">
                    <h3 class="text-gray-500 text-sm font-medium text-yellow-500">Pesan Baru (Inbox)</h3>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $unreadCount ?? 0 }}</p>
                </div>

            </div>

            <div class="mt-8 bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span>Aktivitas Terbaru</span>
                    <span class="block w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                </h3>

                <ul class="space-y-3 text-gray-600 text-sm">
                    @if(isset($unreadCount) && $unreadCount > 0)
                    <li class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border border-blue-100 shadow-sm">
                        <span class="flex items-center gap-3">
                            <span class="p-2 bg-blue-500 text-white rounded-lg">✉</span>
                            <span>Terdapat <strong>{{ $unreadCount }} pendaftaran baru</strong> di Inbox.</span>
                        </span>
                        <a href="{{ route('admin.inbox') }}" class="text-blue-600 font-bold hover:underline">Buka Inbox →</a>
                    </li>
                    @endif

                    @if($pendingSiswa > 0)
                    <li class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-100 shadow-sm">
                        <span class="flex items-center gap-3">
                            <span class="p-2 bg-red-500 text-white rounded-lg">👤</span>
                            <span><strong>{{ $pendingSiswa }} Siswa</strong> butuh konfirmasi status.</span>
                        </span>
                        {{-- Link ini tetap berfungsi sebagai jalan pintas --}}
                        <a href="{{ route('admin.verifikasi') }}" class="text-red-600 font-bold hover:underline">Cek Sekarang →</a>
                    </li>
                    @endif
                    
                    <li class="p-3 border-l-4 border-gray-200 ml-2 italic text-gray-400">
                        Belum ada aktivitas teknis lainnya hari ini.
                    </li>
                </ul>
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