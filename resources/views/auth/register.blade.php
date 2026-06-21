<x-guest-layout>
    <div class="relative rounded-3xl shadow-2xl border border-indigo-100 overflow-hidden bg-gradient-to-br from-white via-blue-50 to-indigo-50 backdrop-blur-sm transition duration-500 hover:shadow-indigo-200">
        
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-indigo-500 via-blue-500 to-purple-500"></div>

        <div class="p-8 bg-gradient-to-r from-indigo-50 to-blue-100 border-b border-indigo-200">
            <h1 class="text-xl font-extrabold text-blue-900">Formulir Pendaftaran Siswa</h1>
            <p class="text-sm text-blue-600">Lengkapi data di bawah untuk bergabung dengan Averus.</p>
        </div>

        <div class="px-8 pt-6">
            <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden shadow-inner">
                <div id="progressBar" class="bg-indigo-600 h-full w-0 transition-all duration-700 ease-out"></div>
            </div>
            <div class="flex justify-between items-center mt-2">
                <p class="text-xs font-medium text-gray-500">Progress pengisian</p>
                <span id="progressText" class="text-xs font-bold text-indigo-600">0%</span>
            </div>
        </div>
         
        @if ($errors->any())
        <div class="mx-8 mt-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span class="font-bold">Ada kesalahan pengisian:</span>
            </div>
            <ul class="list-disc list-inside text-sm opacity-90">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}" class="p-8 space-y-8" id="regForm">
            @csrf
            
            <div class="space-y-6 p-6 rounded-2xl bg-white/60 border border-white shadow-sm">
                <h5 class="text-md font-bold text-gray-800 flex items-center">
                    <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3 text-sm">1</span>
                    Informasi Dasar
                </h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="CONTOH: BUDI HERDIANTO" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm uppercase">
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm bg-white">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Asal Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="school" value="{{ old('school') }}" placeholder="Contoh: SMK Negeri 1 Bandung" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Kelas <span class="text-red-500">*</span></label>
                        <select name="kelas_id" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm bg-white">
                            <option value="">Pilih Kelas</option>
                            @foreach ($daftar_kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-y-6 p-6 rounded-2xl bg-white/60 border border-white shadow-sm">
                <h5 class="text-md font-bold text-gray-800 flex items-center">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mr-3 text-sm">2</span>
                    Minat & Bakat
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Hobi</label>
                        <input type="text" name="hobby" value="{{ old('hobby') }}" placeholder="Membaca, Coding, Musik"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Mata Pelajaran Favorit</label>
                        <input type="text" name="favorite_subject" value="{{ old('favorite_subject') }}" placeholder="Matematika, IPA, dll"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                    </div>
                </div>
            </div>

            <div class="space-y-6 p-6 rounded-2xl bg-white/60 border border-white shadow-sm">
                <h5 class="text-md font-bold text-gray-800 flex items-center">
                    <span class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mr-3 text-sm">3</span>
                    Kontak & Alamat
                </h5>
                <div class="space-y-5">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Alamat Domisili <span class="text-red-500">*</span></label>
                        <textarea name="address" rows="3" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm"
                            placeholder="Jl. Nama Jalan No. RT/RW, Kecamatan, Kota">{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">Nama Orang Tua / Wali <span class="text-red-500">*</span></label>
                            <input type="text" name="parent_name" value="{{ old('parent_name') }}" required
                                class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">WhatsApp Orang Tua <span class="text-red-500">*</span></label>
                            <input type="tel" name="parent_phone" value="{{ old('parent_phone') }}" required placeholder="08xxxxxxxxxx"
                                class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6 p-6 rounded-2xl bg-white/60 border border-white shadow-sm">
                <h5 class="text-md font-bold text-gray-800 flex items-center">
                    <span class="w-8 h-8 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center mr-3 text-sm">4</span>
                    Akun & Sosial Media
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Instagram</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></span>
                            <input type="text" name="instagram" value="{{ old('instagram') }}" placeholder="username"
                                class="w-full pl-8 pr-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">TikTok</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></span>
                            <input type="text" name="tiktok" value="{{ old('tiktok') }}" placeholder="username"
                                class="w-full pl-8 pr-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Email Akun <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@aktif.com"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">WhatsApp Siswa <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="08xxxxxxxxxx"
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-sm">
                    </div>
                </div>
            </div>

            <input type="hidden" name="role" value="siswa">

            <div class="flex flex-col md:flex-row items-center justify-between pt-8 gap-4 border-t border-gray-100">
                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Sudah punya akun? Login
                </a>
                <button type="submit" id="submitBtn" class="w-full md:w-auto px-10 py-3.5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-md font-bold shadow-xl shadow-indigo-200 transition transform active:scale-95">
                    Selesaikan Pendaftaran
                </button>
            </div>
        </form>
    </div>

    <script>
        const inputs = document.querySelectorAll("input, textarea, select");
        const progressBar = document.getElementById("progressBar");
        const progressText = document.getElementById("progressText");
        const submitBtn = document.getElementById("submitBtn");
        const form = document.getElementById("regForm");

        function updateProgress() {
            let filled = 0;
            let totalInputs = 0;
            
            inputs.forEach(input => {
                if (input.type !== "hidden" && input.type !== "password" && input.name !== "password_confirmation") {
                    totalInputs++;
                    if (input.value.trim() !== "") {
                        filled++;
                    }
                }
            });

            const percent = Math.round((filled / totalInputs) * 100);
            progressBar.style.width = percent + "%";
            progressText.innerText = percent + "%";
        }

        inputs.forEach(input => {
            input.addEventListener("input", updateProgress);
            input.addEventListener("change", updateProgress);
            
            // Highlight validation error on blur
            input.addEventListener("blur", function () {
                if (input.value.trim() === "" && input.hasAttribute("required")) {
                    input.classList.add("border-red-400", "bg-red-50");
                } else {
                    input.classList.remove("border-red-400", "bg-red-50");
                }
            });
        });

        // Form Submit Loading State
        form.addEventListener("submit", function () {
            submitBtn.innerHTML = `
                <div class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                </div>
            `;
            submitBtn.disabled = true;
            submitBtn.classList.add("opacity-70", "cursor-not-allowed");
        });

        // Initialize progress
        updateProgress();
    </script>
</x-guest-layout>