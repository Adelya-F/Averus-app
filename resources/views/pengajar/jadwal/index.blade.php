<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex">

<aside class="w-64 bg-blue-500 text-white hidden md:flex md:flex-col">

    <div class="p-6 text-2xl font-bold border-b border-blue-700">
        Averus Pengajar
    </div>

    <nav class="flex-1 p-4 space-y-3">

        <a href="{{ route('pengajar.dashboard') }}"
           class="block px-4 py-2 rounded-lg hover:bg-blue-700 transition">
             Dashboard
        </a>

        <a href="{{ route('pengajar.jadwal.index') }}"
           class="block px-4 py-2 rounded-lg bg-blue-700 font-semibold">
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

<div class="flex-1 flex flex-col">

    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-700">
            Jadwal Mengajar
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

    <main class="p-6 flex-1">

        <div class="bg-white p-6 rounded-xl shadow">
            
            @if($jadwal_pengajar->isEmpty())
                <div class="p-8 text-center">
                    <p class="text-gray-500 text-sm">Tidak ada jadwal mengajar aktif untuk hari ini ke depan bray.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-6 py-3">Hari & Tanggal</th>
                                <th class="px-6 py-3">Jam Belajar</th>
                                <th class="px-6 py-3">Mata Pelajaran</th>
                                <th class="px-6 py-3">Kelas</th>
                                <th class="px-6 py-3">Pengajar / Guru</th> 
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($jadwal_pengajar as $jadwal)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold border border-blue-100">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }} WIB
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-700">
                                        {{ $jadwal->mapel->nama_mapel }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-500">
                                        {{ $jadwal->kelas->nama_kelas }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-700">
                                        {{ $jadwal->guru->name ?? 'Belum Ditentukan' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>

    </main>

</div>

</body>
</html>