<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mapel - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-50 min-h-screen">

<header class="bg-gradient-to-r from-blue-300 to-indigo-500 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <div class="flex items-center gap-4">

            <a href="{{ route('admin.dashboard') }}"
               class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow hover:bg-blue-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <h1 class="text-white text-xl font-semibold">
                Data Mata Pelajaran
                <span class="text-red-500">A</span>
                <span class="text-yellow-500">v</span>
                <span class="text-green-500">e</span>
                <span class="text-blue-500">r</span>
                <span class="text-purple-500">u</span>
                <span class="text-pink-500">s</span>
            </h1>

        </div>
    </div>
</header>

<div class="max-w-7xl mx-auto px-6 py-10">

    <button onclick="document.getElementById('modalMapel').classList.remove('hidden')"
       class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow transition inline-flex items-center gap-2 font-medium">
        <span>+ Tambah Mapel</span>
    </button>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden mt-6">

        <table class="w-full text-sm">

            <thead class="bg-blue-50 text-blue-700 border-b">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold w-20">No</th>
                    <th class="px-6 py-4 text-left font-semibold">Nama Mata Pelajaran</th>
                    <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($mapels as $index => $data)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-500">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $data->nama_mapel }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.mapel.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mapel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-medium px-4 py-2 rounded-full shadow transition inline-flex items-center gap-1.5">
                                    ✕ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-400 font-medium">
                            Belum ada data mata pelajaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalMapel" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h3 class="text-lg font-bold text-gray-800">Tambah Mata Pelajaran</h3>
            <button onclick="document.getElementById('modalMapel').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        
        <form action="{{ route('admin.mapel.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 mb-2 uppercase tracking-wide">Nama Mapel</label>
                <input type="text" name="nama_mapel" required placeholder="Contoh: Laravel"
                    class="w-full p-3 bg-stone-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
            </div>
            
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modalMapel').classList.add('hidden')"
                    class="px-6 py-2 text-gray-500 font-medium hover:text-gray-700">Batal</button>
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-8 py-2 rounded-xl font-bold shadow transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<footer class="bg-stone-100 text-gray-400 py-6 mt-20 text-center text-xs">
    © 2026 Averus. Semua hak cipta dilindungi.
</footer>

</body>
</html>