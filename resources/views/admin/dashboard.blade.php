<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!--SIDEBAR-->
<body class="bg-gray-100 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-blue-400 text-white 
    transform -translate-x-full transition-transform duration-300 ease-in-out
    md:relative md:translate-x-0 md:flex md:flex-col">
    
    <div class="p-6 text-2xl font-bold border-b border-blue-700 flex justify-between items-center drop-shadow-md">
        <div>
            <span class="text-red-500">A</span>
            <span class="text-yellow-500">v</span>
            <span class="text-green-400">e</span>
            <span class="text-blue-500">r</span>
            <span class="text-purple-500">u</span>
            <span class="text-pink-500">s</span>
            Admin
        </div>
        <button id="closeSidebar" class="md:hidden text-white focus:outline-none">
            <span class="text-2xl">✕</span>
        </button>
    </div>


        <nav class="flex-1 p-4 space-y-3">
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Dashboard</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Data Siswa</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Data Pengajar</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">jadwal</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Laporan</a>
            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-700">Inbox</a>
        </nav>


    <div class="p-4 border-t border-blue-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg transition">
                Logout
            </button>
        </form>
    </div>
</aside>

<div id="overlay"
class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden">
</div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
       <header class="bg-[#faf6ef] shadow p-4 flex items-center justify-between">

    <div class="flex items-center gap-4">
        <!-- BUTTON MENU -->
        <button id="openSidebar" class="text-blue-600 text-2xl md:hidden focus:outline-none">
            ☰
        </button>

        <h1 class="text-xl font-semibold text-gray-700">
            Dashboard Admin
        </h1>
    </div>

   <a href="{{ route('profile.edit') }}" 
   class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-xl transition-all duration-200 hover:shadow-sm">

    <!-- NAMA -->
    <span class="text-sm text-gray-700 font-medium">
        {{ Auth::user()->name }}
    </span>

    <!-- FOTO BULAT (INITIAL) -->
    <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>

</a>
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

<script>
    const sidebar = document.getElementById('sidebar');
    const openBtn = document.getElementById('openSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');

    openBtn.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>

</body>
</html>