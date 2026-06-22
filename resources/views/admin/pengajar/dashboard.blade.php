<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Pengajar - Averus</title>
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
                Pengajar
            </div>
            <button id="closeSidebar" class="md:hidden text-white focus:outline-none">
                <span class="text-2xl">✕</span>
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-3">
            <a href="{{ route('pengajar.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
               </svg>
               Dashboard
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
               </svg>
               Edit Profile
            </a>

            <a href="{{ route('pengajar.jadwal') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7H3v11a2 2 0 002 2z" />
               </svg>
               Jadwal Mengajar
            </a>

            <a href="{{ route('pengajar.absensi') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg bg-blue-700 font-semibold shadow-inner">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
               </svg>
               Absensi
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3m0 0l-3-3m3 3l-3 3M4 6h7a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
               </svg>
               Laporan
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
                <h1 class="text-xl font-semibold text-gray-700">Absensi Pengajar</h1>
            </div>

            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-xl transition-all duration-200">
                <span class="text-sm text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold shadow-sm overflow-hidden">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/avatars/'.Auth::user()->avatar) }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
            </a>
        </header>

        <main class="p-6 flex-1">

            {{-- NOTIF --}}
            @if(session('success'))
                <div class="flex items-center gap-2 bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-r-lg mb-4 text-sm font-medium shadow-sm">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center gap-2 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r-lg mb-4 text-sm font-medium shadow-sm">
                    <span>⚠️</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- TOMBOL ABSEN --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-indigo-500 rounded-3xl p-8 text-center text-white shadow-lg shadow-blue-200 mb-6">

                <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-16 -left-8 w-48 h-48 rounded-full bg-white/5"></div>

                <p class="relative text-xs uppercase tracking-widest font-semibold opacity-80">
                    Waktu Sekarang
                </p>

                <p id="liveClock" class="relative text-4xl font-extrabold mt-1 tabular-nums">
                    {{ now()->format('H:i:s') }}
                </p>

                <p class="relative text-sm font-medium opacity-90 mb-6">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>

                <form action="{{ route('pengajar.absensi.store') }}" method="POST" class="relative inline-block">
                    @csrf
                    <button type="submit"
                        class="bg-white text-blue-600 font-bold px-8 py-3 rounded-xl shadow-md hover:bg-gray-100 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150">
                        ✅ Absen Sekarang
                    </button>
                </form>
            </div>

            {{-- RIWAYAT --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-bold text-gray-800">📊 Riwayat Absensi</h4>
                    @if($absensis->count() > 0)
                        <span class="bg-blue-100 text-blue-600 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $absensis->count() }} Tercatat
                        </span>
                    @endif
                </div>

                <div class="space-y-2">
                    @forelse($absensis as $i => $absen)
                        <div class="flex items-center gap-3 bg-gray-50 border border-gray-100 hover:border-blue-300 rounded-xl px-4 py-3 transition">
                            <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-blue-600 text-white text-sm font-bold flex items-center justify-center">
                                {{ $i + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-700 text-sm">
                                    {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}
                                </p>
                                <p class="text-xs text-gray-400 font-medium">
                                    {{ \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i:s') }}
                                </p>
                            </div>
                            <span class="flex-shrink-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                {{ $absen->status }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <div class="text-4xl mb-2 opacity-60">🗒️</div>
                            <p class="text-gray-400 italic text-sm font-medium">Belum ada absensi</p>
                        </div>
                    @endforelse
                </div>
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

        function tickClock() {
            const el = document.getElementById('liveClock');
            if (!el) return;
            const now = new Date();
            const pad = (n) => String(n).padStart(2, '0');
            el.textContent = `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
        }
        setInterval(tickClock, 1000);
    </script>
</body>
</html>