<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between border-b border-blue-100 pb-4">
            <div>
                <h2 class="text-2xl font-semibold text-blue-700 leading-tight">
                    Panel Administrasi
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Sistem Manajemen Pembelajaran
                </p>
            </div>

            <div>
                <span class="px-4 py-2 bg-amber-400 text-amber-900 text-sm font-medium rounded-full">
                    Admin
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-blue-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Card Utama -->
            <div class="bg-white overflow-hidden shadow-lg shadow-blue-100 rounded-xl border border-blue-100">
                <div class="p-8">

                    <h3 class="text-lg font-semibold text-blue-700 mb-4">
                        Selamat Datang
                    </h3>

                    <p class="text-gray-600 mb-6">
                        Anda berhasil masuk ke sistem. Gunakan menu navigasi untuk mengelola data siswa, guru, dan pembelajaran.
                    </p>

                    <button class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                        Kelola Data
                    </button>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>