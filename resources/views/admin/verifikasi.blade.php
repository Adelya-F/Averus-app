<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Siswa - Averus Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="p-6">
        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center justify-center w-10 h-10 bg-white border border-gray-200 text-gray-600 rounded-xl shadow-sm hover:bg-gray-50 hover:text-blue-600 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">Verifikasi Pendaftaran Siswa</h1>
                <p class="text-gray-500 text-sm">Tinjau dan setujui pendaftaran siswa baru di sini.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-5 flex items-center p-4 text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold text-blue-600">Nama Siswa</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-blue-600">Sekolah / Kelas</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-blue-600">No. WhatsApp</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center text-blue-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($siswas as $siswa)
                        <tr class="bg-white hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $siswa->name }}</div>
                                <div class="text-xs text-gray-400 font-mono">{{ $siswa->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-50 text-blue-700 text-[11px] font-medium px-2.5 py-0.5 rounded border border-blue-100 uppercase">
                                    {{ $siswa->school }}
                                </span>
                                <div class="mt-1 font-semibold text-gray-600">Kelas: {{ $siswa->class }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $siswa->phone }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    <form action="{{ route('admin.verifikasi.update', $siswa->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-bold rounded-lg text-xs px-4 py-2 transition-all transform hover:scale-105 shadow-sm">
                                            TERIMA
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.verifikasi.update', $siswa->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="text-red-600 hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-xs px-4 py-2 text-center transition-all">
                                            TOLAK
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-5xl mb-4 text-gray-300">📬</span>
                                    <p class="text-gray-400 font-medium text-lg italic italic text-center">Hore! Tidak ada pendaftar baru yang perlu diverifikasi.</p>
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