<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        
        <div class="bg-blue-500 p-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                <span class="text-3xl">👤</span>
            </div>
            <h1 class="text-xl font-bold text-white uppercase tracking-wide">Halo, {{ auth()->user()->name }}</h1>
            <p class="text-blue-100 text-sm opacity-90">ID Pendaftaran: #AVR-{{ auth()->user()->id + 1000 }}</p>
        </div>

        <div class="p-8">
            <div class="text-center mb-8">
                <p class="text-gray-500 text-xs uppercase font-bold tracking-widest mb-2">Status Pendaftaran</p>
                
                @if(auth()->user()->status == 'accepted')
                    <span class="inline-block px-6 py-2 rounded-full bg-green-100 text-green-700 font-bold text-sm border border-green-200">
                        ✅ {{ strtoupper(auth()->user()->status) }}
                    </span>
                @elseif(auth()->user()->status == 'rejected')
                    <span class="inline-block px-6 py-2 rounded-full bg-red-100 text-red-700 font-bold text-sm border border-red-200">
                        ❌ DITOLAK
                    </span>
                @else
                    <span class="inline-block px-6 py-2 rounded-full bg-orange-100 text-orange-700 font-bold text-sm border border-orange-200 animate-pulse">
                        ⏳ {{ strtoupper(auth()->user()->status ?? 'PENDING') }}
                    </span>
                @endif
            </div>

            <div class="bg-gray-50 rounded-xl p-4 mb-8 space-y-3 border border-gray-100">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-tighter border-b border-gray-200 pb-2 mb-3">Data Terdaftar</h3>
                
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Sekolah</span>
                    <span class="font-semibold text-gray-700">{{ auth()->user()->school }}</span>
                </div>
                
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Kelas</span>
                    <span class="font-semibold text-gray-700">Kelas {{ auth()->user()->class }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Tanggal Lahir</span>
                    <span class="font-semibold text-gray-700">
                        {{ auth()->user()->tanggal_lahir ? \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->format('d F Y') : '-' }}
                    </span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">No. WhatsApp</span>
                    <span class="font-semibold text-gray-700">{{ auth()->user()->phone }}</span>
                </div>
            </div>

            <div class="space-y-4">
                @if(auth()->user()->status == 'accepted')
                    <div class="p-4 bg-green-50 border border-green-100 rounded-xl text-center">
                        <p class="text-green-800 text-sm font-medium mb-3 italic">Selamat! Akun Anda sudah aktif dan siap digunakan.</p>
                        <a href="{{ route('siswa.dashboard') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition-all shadow-md transform hover:-translate-y-1 text-center">
                            Masuk ke Dashboard →
                        </a>
                    </div>
                @elseif(auth()->user()->status == 'rejected')
                    <div class="p-4 bg-red-50 border border-red-100 rounded-xl text-center">
                        <p class="text-red-800 text-sm font-medium italic">Maaf, pendaftaran Anda belum disetujui. Silakan hubungi admin di kantor Bimbel.</p>
                    </div>
                @else
                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl text-center">
                        <p class="text-blue-800 text-sm font-medium leading-relaxed italic">
                            Mohon tunggu sebentar ya, Admin kami sedang memverifikasi data pendaftaranmu.
                        </p>
                    </div>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-gray-400 hover:text-red-500 text-xs font-semibold py-2 transition-colors">
                        Logout / Keluar Akun
                    </button>
                </form>
            </div>
        </div>

        <div class="h-2 w-full flex">
            <div class="flex-1 bg-red-500"></div>
            <div class="flex-1 bg-yellow-500"></div>
            <div class="flex-1 bg-green-400"></div>
            <div class="flex-1 bg-blue-500"></div>
            <div class="flex-1 bg-purple-500"></div>
        </div>
    </div>

</body>
</html>