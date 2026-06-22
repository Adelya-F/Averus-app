<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- NAVBAR ATAS --}}
    <header class="bg-gradient-to-r from-blue-500 to-indigo-500 shadow-md sticky top-0 z-50">
        <div class="px-4 py-3 flex items-center gap-4">
            <a href="{{ route('siswa.dashboard') }}"
               class="bg-white text-gray-700 w-10 h-10 rounded-xl flex items-center justify-center shadow hover:bg-gray-100 transition flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div class="flex items-center gap-2">
                <img src="{{ asset('image/averus.png') }}" alt="Logo Averus" class="h-8 w-auto">
                <h1 class="text-xl font-bold flex">
                    <span class="text-red-500">A</span>
                    <span class="text-yellow-500">v</span>
                    <span class="text-green-400">e</span>
                    <span class="text-blue-500">r</span>
                    <span class="text-purple-500">u</span>
                    <span class="text-pink-500">s</span>
                </h1>
            </div>
        </div>
    </header>

    <main class="relative z-0 max-w-3xl mx-auto px-4 py-6 flex-1 w-full">

        <h2 class="text-2xl font-extrabold text-gray-800 mb-6">
            <span class="mr-1">📋</span>Absensi Siswa
        </h2>

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

            <form action="{{ route('siswa.absen.store') }}" method="POST" class="relative inline-block">
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
                                {{ \Carbon\Carbon::parse($absen->tanggal)->format('H:i:s') }}
                            </p>
                        </div>
                        <span class="flex-shrink-0 bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            Hadir
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

    <section class="py-10 bg-gradient-to-r from-yellow-300 to-amber-100 text-center mt-auto">
        <footer class="text-amber-900 font-medium">
            &copy; 2026 Averus. Semua hak cipta dilindungi.
        </footer>
    </section>

    <script>
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