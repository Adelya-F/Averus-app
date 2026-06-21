<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa - Averus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

<div class="max-w-4xl mx-auto px-6 py-8">
    {{-- Breadcrumb / Navigasi Balik --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="javascript:void(0)" onclick="window.history.back();"
           class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 shadow-sm text-gray-600 hover:text-indigo-600 hover:border-indigo-100 transition transform active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Data Siswa</h1>
            <p class="text-sm text-gray-500">Mengubah profil lengkap atas nama <span class="font-semibold text-indigo-600">{{ $siswa->name }}</span></p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="relative rounded-3xl shadow-xl border border-gray-100 overflow-hidden bg-white">
        
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>

        <div class="p-6 bg-gray-50/50 border-b border-gray-100">
            <h2 class="text-base font-bold text-gray-800">Formulir Pembaruan Data</h2>
            <p class="text-xs text-gray-400">Pastikan data kontak dan sekolah asal sudah benar sebelum disimpan.</p>
        </div>

        @if ($errors->any())
        <div class="mx-6 mt-6 bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-r-xl shadow-sm">
            <ul class="text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form Action --}}
        <form method="POST" action="{{ route('admin.siswa.update-direct', $siswa->id) }}" class="p-6 space-y-8">
            @csrf
            @method('PUT')

            {{-- 1. IDENTITAS UTAMA SISWA --}}
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-indigo-600 uppercase tracking-wider border-b border-indigo-50 pb-1">1. Identitas Utama</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $siswa->name) }}" required
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $siswa->email) }}" required
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Password <span class="text-gray-400 font-normal">(Kosongkan jika tidak diubah)</span></label>
                        <input type="password" name="password" placeholder="••••••••"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Sekolah Asal</label>
                        <input type="text" name="school" value="{{ old('school', $siswa->school) }}"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>
                </div>
            </div>

            {{-- 2. DATA PROFIL & LAHIR --}}
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-indigo-600 uppercase tracking-wider border-b border-indigo-50 pb-1">2. Profil & Kontak Fisik</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">No. HP / WA Siswa</label>
                        <input type="text" name="phone" value="{{ old('phone', $siswa->phone) }}"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-600">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">{{ old('address', $siswa->address) }}</textarea>
                </div>
            </div>

            {{-- 3. DATA ORANG TUA --}}
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-indigo-600 uppercase tracking-wider border-b border-indigo-50 pb-1">3. Data Orang Tua / Wali</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Nama Orang Tua</label>
                        <input type="text" name="parent_name" value="{{ old('parent_name', $siswa->parent_name) }}"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">No. WA Orang Tua</label>
                        <input type="text" name="parent_phone" value="{{ old('parent_phone', $siswa->parent_phone) }}"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>
                </div>
            </div>

            {{-- 4. PERSONALISASI --}}
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-indigo-600 uppercase tracking-wider border-b border-indigo-50 pb-1">4. Minat & Sosial Media</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Hobi Siswa</label>
                        <input type="text" name="hobby" value="{{ old('hobby', $siswa->hobby) }}" placeholder="Contoh: Basket, Coding"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Mata Pelajaran Favorit</label>
                        <input type="text" name="favorite_subject" value="{{ old('favorite_subject', $siswa->favorite_subject) }}" placeholder="Contoh: Matematika, Bahasa Inggris"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Username Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $siswa->instagram) }}" placeholder="@username"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Username TikTok</label>
                        <input type="text" name="tiktok" value="{{ old('tiktok', $siswa->tiktok) }}" placeholder="@username"
                               class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none text-sm transition">
                    </div>
                </div>
            </div>

            {{-- HANYA TOMBOL SIMPAN YANG DI DALAM FORM --}}
            <div class="flex items-center justify-end pt-6 border-t border-gray-100">
                <button type="submit" id="btnSubmit" class="px-8 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-100 transition transform active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form> {{-- FORM BERAKHIR DI SINI --}}

        {{-- TOMBOL BATAL & KEMBALI AMAN DI LUAR FORM --}}
        <div class="px-6 pb-6 bg-white rounded-b-3xl">
            <div class="flex items-center justify-start">
                <a href="javascript:void(0)" onclick="window.history.back();" class="text-sm font-semibold text-gray-500 hover:text-indigo-600 transition">
                    ← Batal & Kembali
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    // JS hanya mendengarkan klik simpan, navigasi back biasa jadi ga ke-block
    document.querySelector("form").addEventListener("submit", function () {
        const btn = document.getElementById("btnSubmit");
        btn.innerHTML = "⏳ Menyimpan...";
        btn.disabled = true;
        btn.classList.add("opacity-70");
    });
</script>

</body>
</html>