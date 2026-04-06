<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengajar - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Custom Select2 agar serasi dengan desain baru */
        .select2-container--default .select2-selection--multiple {
            border-radius: 0.75rem !important;
            border-color: #e5e7eb !important;
            padding: 5px !important;
            transition: all 0.3s;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #6366f1 !important;
            ring: 2px #e0e7ff;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #6366f1 !important;
            color: white !important;
            border: none !important;
            border-radius: 0.5rem !important;
            padding: 2px 8px !important;
        }
    </style>
</head>
<body class="bg-stone-50 min-h-screen">

    <header class="bg-gradient-to-r from-indigo-500 via-blue-500 to-purple-500 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.pengajar') }}"
                   class="w-10 h-10 flex items-center justify-center bg-white/20 backdrop-blur-md rounded-xl shadow-sm hover:bg-white/30 transition text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-white text-xl font-bold tracking-tight">
                    Tambah Pengajar <span class="bg-white/20 px-3 py-1 rounded-lg ml-2">Averus</span>
                </h1>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="relative rounded-3xl shadow-2xl border border-indigo-100 overflow-hidden bg-gradient-to-br from-white via-blue-50 to-indigo-50 backdrop-blur-sm transition duration-500">
            
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-indigo-500 via-blue-500 to-purple-500"></div>

            <div class="p-8 bg-gradient-to-r from-indigo-50 to-blue-100 border-b border-indigo-200">
                <h2 class="text-lg font-bold text-blue-800">Formulir Data Baru</h2>
                <p class="text-sm text-blue-600">Lengkapi data profil pengajar Averus dengan teliti.</p>
            </div>

            @if ($errors->any())
            <div class="mx-8 mt-6 bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-r-xl shadow-sm">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.pengajar.store') }}" class="p-8 space-y-10">
                @csrf

                <div class="space-y-6 p-6 rounded-2xl bg-white/70 backdrop-blur-sm border border-indigo-50 shadow-sm">
                    <h5 class="text-md font-semibold text-gray-800 border-b pb-2 flex items-center gap-2">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full"></span> Identitas Utama
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">NIP</label>
                            <input type="text" name="nip" value="{{ old('nip') }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="space-y-6 p-6 rounded-2xl bg-white/70 backdrop-blur-sm border border-indigo-50 shadow-sm">
                    <h5 class="text-md font-semibold text-gray-800 border-b pb-2 flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Kontak & Akun
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">Password</label>
                            <input type="password" name="password" required
                                   class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">No. HP / WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">Mata Pelajaran</label>
                            <select name="mata_pelajaran[]" id="select-mapel" class="w-full" multiple required>
                                @foreach($mapels as $mapel)
                                    <option value="{{ $mapel->nama_mapel }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 p-6 rounded-2xl bg-white/70 backdrop-blur-sm border border-indigo-50 shadow-sm">
                    <h5 class="text-md font-semibold text-gray-800 border-b pb-2 flex items-center gap-2">
                        <span class="w-2 h-2 bg-purple-500 rounded-full"></span> Data Tambahan
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" required
                                   class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required
                                    class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                                <option value="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-gray-700">Alamat Lengkap</label>
                        <textarea name="address" rows="3" required
                                  class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.pengajar') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition">
                        ← Kembali ke Daftar
                    </a>
                    <button type="submit" id="btnSubmit" class="px-8 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md shadow-indigo-100 transition transform active:scale-95">
                        Simpan Data Pengajar
                    </button>
                </div>

            </form>
        </div>
    </div>

    <footer class="text-gray-400 py-8 text-center text-xs">
        © 2026 Averus. Semua hak cipta dilindungi.
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#select-mapel').select2({
                placeholder: " Pilih mata pelajaran...",
                allowClear: true
            });

            const inputs = document.querySelectorAll("input, textarea, select");
            const progressBar = document.getElementById("progressBar");
            const progressText = document.getElementById("progressText");

            function updateProgress() {
                let filled = 0;
                let totalInputs = 0;
                
                inputs.forEach(input => {
                    if (input.type !== "hidden" && input.type !== "password") {
                        totalInputs++;
                        if (input.value && input.value.trim() !== "") {
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
            });

            // Update progress awal
            updateProgress();

            // Efek Loading saat Submit
            const form = document.querySelector("form");
            form.addEventListener("submit", function () {
                const btn = document.getElementById("btnSubmit");
                btn.innerHTML = "⏳ Menyimpan...";
                btn.disabled = true;
                btn.classList.add("opacity-70");
            });

            // Validasi visual saat kehilangan fokus
            inputs.forEach(input => {
                input.addEventListener("blur", function () {
                    if (input.value.trim() === "" && input.hasAttribute("required")) {
                        input.classList.add("border-red-400");
                    } else {
                        input.classList.remove("border-red-400");
                    }
                });
            });
        });
    </script>
</body>
</html>