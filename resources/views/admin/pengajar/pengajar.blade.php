<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pengajar - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-50 min-h-screen">

<!-- HEADER -->
<header class="bg-gradient-to-r from-blue-300 to-indigo-500 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- LEFT -->
        <div class="flex items-center gap-4">

            <!-- BACK BUTTON -->
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

            <h1 class="text-white text-xl font-semibold">
                Data Pengajar
                <span class="text-red-500">A</span>
                <span class="text-yellow-500">v</span>
                <span class="text-green-500">e</span>
                <span class="text-blue-500">r</span>
                <span class="text-purple-500">u</span>
                <span class="text-pink-500">s</span>
            </h1>
            </h1>

        </div>
    </div>
</header>

<!-- CONTENT -->
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- BUTTON TAMBAH -->
    <a href="{{ route('admin.pengajar.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow transition">
       + Tambah Pengajar
    </a>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden mt-6">

        <table class="w-full text-sm">

            <thead class="bg-blue-50 text-blue-700">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">Nama</th>
                    <th class="px-6 py-4 text-left font-semibold">Mata Pelajaran</th>
                    <th class="px-6 py-4 text-left font-semibold">No telp</th>
                    <th class="px-6 py-4 text-left font-semibold">Email</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($pengajar as $data)
                    <tr class="hover:bg-blue-50 transition">

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $data->nama }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $data->mata_pelajaran }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $data->no_hp }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $data->email }}
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-12 text-center text-gray-400">
                            Belum ada data pengajar.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- FOOTER -->
<footer class="bg-stone-100 text-gray-600 py-6 mt-20 text-center text-sm">
    © 2026 Averus. Semua hak cipta dilindungi.
</footer>

</body>
</html>