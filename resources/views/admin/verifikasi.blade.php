<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Siswa - Averus Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8f6f2]">

<div class="p-6 max-w-7xl mx-auto">
@if(session('success'))
    <div class="mb-6 p-4 bg-green-500 text-white rounded-xl shadow-lg flex items-center justify-between animate-bounce-short">
        <div class="flex items-center gap-3">
            <span>✅</span>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-white/80 hover:text-white">✕</button>
    </div>
@endif
   <!-- HEADER -->
<div class="mb-8 flex items-center justify-between">

    <!-- KIRI: BACK + TITLE -->
    <div class="flex items-center gap-4">

         <a href="{{ route('admin.dashboard') }}"
               class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow hover:bg-blue-50 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-gray-700"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>

            </a>

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Verifikasi Pendaftaran Siswa
            </h1>
            <div class="h-1 w-16 bg-blue-500 rounded-full mt-2"></div>
            <p class="text-gray-500 text-sm mt-2">
                Tinjau dan setujui pendaftaran siswa baru.
            </p>
        </div>

    </div>

    <!-- KANAN: BADGE -->
    <div class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-sm">
        {{ $siswas->count() }} Menunggu
    </div>

</div>

    <!-- MINI STATISTIC -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-yellow-500 p-4">
            <p class="text-sm text-gray-500">Menunggu Verifikasi</p>
            <p class="text-2xl font-bold text-yellow-500">
                {{ $siswas->count() }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-green-500 p-4">
            <p class="text-sm text-gray-500 font-bold">Diterima Hari Ini</p>
            <p class="text-2xl font-bold text-green-500">
                {{ $diterimaHariIni }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-red-500 p-4">
            <p class="text-sm text-gray-500 font-bold">Ditolak Hari Ini</p>
            <p class="text-2xl font-bold text-red-500">
                {{ $ditolakHariIni }}
            </p>
        </div>

    </div>

    <!-- SEARCH -->
    <div class="flex justify-between items-center mb-4">
        <input type="text"
            placeholder="Cari siswa..."
            class="w-64 px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">

        <span class="text-sm text-gray-500">
            Total Data: {{ $siswas->count() }}
        </span>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                <thead class="text-xs text-blue-700 bg-blue-50 border-b border-blue-100">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Nama Siswa</th>
                        <th class="px-6 py-4 font-semibold">Sekolah / Kelas</th>
                        <th class="px-6 py-4 font-semibold">No. WhatsApp</th>
                        <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($siswas as $siswa)
                    <tr class="hover:bg-blue-50/40 transition-all duration-200">

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-semibold">
                                    {{ strtoupper(substr($siswa->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">
                                        {{ $siswa->name }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $siswa->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-gray-700 font-medium">
                                {{ $siswa->school }}
                            </div>
                            <div class="text-xs text-gray-400">
                                Kelas: {{ $siswa->class }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $siswa->phone }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                <form action="{{ route('admin.verifikasi.update', $siswa->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin MENERIMA pendaftaran {{ $siswa->name }}?')"
                                            class="text-white bg-green-500 hover:bg-green-600 font-semibold rounded-lg text-xs px-4 py-2 transition shadow-sm hover:shadow-md">
                                        Terima
                                    </button>
                                </form>

                                <form action="{{ route('admin.verifikasi.update', $siswa->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin MENOLAK pendaftaran {{ $siswa->name }}?')"
                                            class="text-red-600 border border-red-300 hover:bg-red-50 font-semibold rounded-lg text-xs px-4 py-2 transition">
                                        Tolak
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="text-5xl mb-4 text-gray-300">📬</div>
                                <p class="text-gray-400 font-medium text-lg italic">
                                    Tidak ada pendaftar baru untuk diverifikasi.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>

</body>
</html>