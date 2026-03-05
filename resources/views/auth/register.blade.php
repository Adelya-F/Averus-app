@extends('layouts.app')

<x-guest-layout>
    <div class="relative rounded-3xl shadow-2xl border border-indigo-100 overflow-hidden
            bg-gradient-to-br from-white via-blue-50 to-indigo-50
            backdrop-blur-sm transition duration-500 hover:shadow-indigo-200">
    
    <!-- Accent Top Line -->
    <div class="absolute top-0 left-0 w-full h-2 
                bg-gradient-to-r from-indigo-500 via-blue-500 to-purple-500"></div>

    <!-- Header Form -->
    <div class="p-8 bg-gradient-to-r from-indigo-50 to-blue-100 border-b border-indigo-200">
        <h2 class="text-lg font-bold text-blue-800">Formulir Pendaftaran Siswa</h2>
        <p class="text-sm text-blue-600">Pastikan semua data diisi dengan benar.</p>
    </div>

    <div class="px-8 pt-6">
    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
        <div id="progressBar" 
             class="bg-indigo-600 h-2 w-0 transition-all duration-500"></div>
    </div>
    <p class="text-xs text-gray-500 mt-2">
        Progress pengisian: <span id="progressText">0%</span>
    </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="p-8 space-y-10">
        @csrf
        
        <!-- INFORMASI DASAR -->
        <div class="space-y-6 p-6 rounded-2xl bg-white/70 backdrop-blur-sm border border-indigo-50 shadow-sm">
            <h3 class="text-md font-semibold text-gray-800 border-b pb-2">
                Informasi Dasar
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Asal Sekolah</label>
                    <input type="text" name="school" value="{{ old('school') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Kelas</label>
                    <select name="class" required
                        class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                        <option value="">Pilih Kelas</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">Kelas {{ $i }}</option>
                        @endfor
                    </select>
                </div>

            </div>
        </div>

        <!-- KONTAK & ALAMAT -->
        <div class="space-y-6">
            <h3 class="text-md font-semibold text-gray-800 border-b pb-2">
                Kontak & Alamat
            </h3>

            <div class="space-y-5">

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Alamat Domisili</label>
                    <textarea name="address" rows="3" required
                        class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">{{ old('address') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Nama Orang Tua / Wali</label>
                        <input type="text" name="parent_name" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">No WhatsApp Orang Tua</label>
                        <input type="text" name="parent_phone" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                    </div>

                </div>
            </div>
        </div>

        <!-- AKUN SISWA -->
        <div class="space-y-6">
            <h3 class="text-md font-semibold text-gray-800 border-b pb-2">
                Akun Siswa
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Alamat Email</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">No WhatsApp Siswa</label>
                    <input type="text" name="phone" required
                        class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                </div>

            </div>
        </div>

        <input type="hidden" name="role" value="siswa">

        <!-- ACTION BUTTON -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-100">

            <a href="{{ route('login') }}"
               class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">
                Sudah punya akun? Login
            </a>

            <button type="submit"
                class="px-8 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-100 transition transform active:scale-95">
                Selesaikan Pendaftaran
            </button>

        </div>
    </form>
</div>
<script>
    // Progress bar otomatis
    const inputs = document.querySelectorAll("input, textarea, select");
    const progressBar = document.getElementById("progressBar");
    const progressText = document.getElementById("progressText");

    function updateProgress() {
        let filled = 0;
        inputs.forEach(input => {
            if (input.value.trim() !== "" && input.type !== "hidden") {
                filled++;
            }
        });

        const percent = Math.round((filled / (inputs.length - 1)) * 100);
        progressBar.style.width = percent + "%";
        progressText.innerText = percent + "%";
    }

    inputs.forEach(input => {
        input.addEventListener("input", updateProgress);
    });

    updateProgress();

    // Disable button saat submit
    const form = document.querySelector("form");
    form.addEventListener("submit", function () {
        const btn = form.querySelector("button[type='submit']");
        btn.innerHTML = "⏳ Mendaftarkan...";
        btn.disabled = true;
        btn.classList.add("opacity-70");
    });

    // Validasi visual realtime
    inputs.forEach(input => {
        input.addEventListener("blur", function () {
            if (input.value.trim() === "" && input.hasAttribute("required")) {
                input.classList.add("border-red-400");
            } else {
                input.classList.remove("border-red-400");
            }
        });
    });
</script>
</x-guest-layout>
