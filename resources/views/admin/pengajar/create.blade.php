<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengajar - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 min-h-screen caret-transparent">

    <header class="bg-gradient-to-r from-blue-300 to-indigo-500 shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.pengajar') }}"
                   class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow hover:bg-blue-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>


                <h1 class="text-white text-xl font-semibold">
                    Tambah Pengajar 
                    <span class="text-red-500">A</span><span class="text-yellow-500">v</span><span class="text-green-500">e</span><span class="text-blue-500">r</span><span class="text-purple-500">u</span><span class="text-pink-500">s</span>
                </h1>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-blue-50 border-b border-blue-100">
                <h2 class="text-lg font-bold text-blue-800">Formulir Data Baru</h2>
                <p class="text-sm text-blue-600">Pastikan semua informasi NIP dan Email sudah benar.</p>
            </div>

            <form method="POST" action="{{ route('admin.pengajar.store') }}" class="p-8 space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                        @error('nip') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                        @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                        @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">No. HP / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                        @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required
                               class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" required
                                class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Alamat Lengkap</label>
                    <textarea name="address" rows="3" required
                              class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">{{ old('address') }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.pengajar') }}" 
                       class="px-6 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-100 transition">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-8 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-100 transition transform active:scale-95">
                        Simpan Data Pengajar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-stone-100 text-gray-400 py-6 text-center text-xs">
        © 2026 Averus. Semua hak cipta dilindungi.
    </footer>

</body>
</html>