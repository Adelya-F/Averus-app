<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-800 text-white hidden md:flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-700">
            Averus Admin
        </div>

        <nav class="flex-1 p-4 space-y-3">
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Dashboard</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Data Siswa</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Data Pengajar</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Laporan</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Inbox</a>
        </nav>

        <div class="p-4 border-t border-blue-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-700">
                Dashboard Admin
            </h1>

            <div class="text-sm text-gray-600">
                Halo, {{ Auth::user()->name }}
            </div>
        </header>

        <!-- CONTENT -->
        <main class="p-6 flex-1">

            <!-- CARD STATISTIK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 text-sm">Total Siswa</h3>
                    <p class="text-3xl font-bold text-blue-700 mt-2">
                        120
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 text-sm">Total Pengajar</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">
                        15
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 text-sm">Kelas Aktif</h3>
                    <p class="text-3xl font-bold text-purple-600 mt-2">
                        8
                    </p>
                </div>

            </div>

            <!-- SECTION TAMBAHAN -->
            <div class="mt-8 bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Aktivitas Terbaru
                </h3>

                <ul class="space-y-2 text-gray-600 text-sm">
                    <li>• Siswa baru mendaftar</li>
                    <li>• Jadwal kelas diperbarui</li>
                    <li>• Pengajar menambahkan materi</li>
                </ul>
            </div>

        </main>

    </div>

</body>
</html>