@extends('layouts.app')

@section('content')

<div class="px-6 py-8">

    <h2 class="text-2xl font-extrabold text-gray-800 mb-6">
        <span class="mr-1">📋</span>Absensi Pengajar
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

</div>

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

@endsection