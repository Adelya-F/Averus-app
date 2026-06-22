@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Buat Jadwal Mingguan</h1>
            <p class="text-sm text-gray-500">Input sesi belajar Averus Bimbel. Mapel otomatis terisi mendeteksi guru yang dipilih.</p>
        </div>
        <a href="{{ route('admin.jadwal.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.jadwal.store') }}" method="POST">
        @csrf
        
        <div id="wrapper-jadwal" class="space-y-4">
            {{-- Kard Baris Pertama (Index 0) --}}
            <div class="jadwal-item bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    {{-- Guru --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Pengajar / Guru</label>
                        <select name="jadwal[0][user_id]" required class="select-guru w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 font-medium text-sm transition">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($gurus as $guru)
                                {{-- Kita selipkan ID Mapel dan Nama Mapel milik guru di sini bray --}}
                                <option value="{{ $guru->id }}" 
                                        data-mapel-id="{{ $guru->mapel->id ?? '' }}" 
                                        data-mapel-nama="{{ $guru->mapel->nama_mapel ?? 'Belum Ada Mapel' }}">
                                    {{ $guru->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kelas --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kelas Target</label>
                        <select name="jadwal[0][kelas_id]" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 font-medium text-sm transition">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Mapel (Gak bisa dipilih manual, readonly otomatis) --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Mata Pelajaran</label>
                        {{-- Input Text Palsu untuk display nama mapel ke admin --}}
                        <input type="text" readonly placeholder="Pilih guru terlebih dahulu..." class="input-mapel-nama w-full px-4 py-3 bg-gray-100 border border-gray-100 rounded-xl text-gray-500 font-medium text-sm focus:outline-none cursor-not-allowed">
                        {{-- Input Hidden Asli yang bakal dikirim ke database --}}
                        <input type="hidden" name="jadwal[0][mapel_id]" class="input-mapel-id" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Tanggal Pelaksanaan --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal Pelaksanaan</label>
                        <input type="date" name="jadwal[0][tanggal]" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 text-sm transition">
                    </div>

                    {{-- Jam Mulai --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Jam Mulai</label>
                        <input type="time" name="jadwal[0][jam_mulai]" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 text-sm transition">
                    </div>

                    {{-- Jam Selesai --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Jam Selesai</label>
                        <input type="time" name="jadwal[0][jam_selesai]" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 text-sm transition">
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Manipulasi Form --}}
        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <button type="button" id="btn-tambah-baris" class="w-full sm:w-auto px-5 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-sm font-bold rounded-xl transition flex items-center justify-center gap-2">
                ➕ Tambah Sesi Kelas Baru
            </button>

            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <a href="{{ route('admin.jadwal.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-500 hover:text-gray-700 transition">Batal</a>
                <button type="submit" class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-sm transition transform active:scale-95">
                    Simpan Semua Jadwal
                </button>
            </div>
        </div>
    </form>
</div>

{{-- JAVASCRIPT MASTER SMART AUTOFILL + LIMIT 7 HARI --}}
<script>
    let barisKe = 1;

    // --- 1. LOGIKA HITUNG RENTANG TANGGAL (HARI INI S/D 7 HARI KE DEPAN) ---
    function dapatkanRentangTanggal() {
        const hariIni = new Date();
        
        // Helper buat format object date ke string YYYY-MM-DD
        const formatTanggal = (date) => date.toISOString().split('T')[0];
        
        const minDate = formatTanggal(hariIni); // Batas minimal = hari ini
        
        const tujuhHariKedepan = new Date();
        tujuhHariKedepan.setDate(hariIni.getDate() + 7); // Batas maksimal = +7 hari
        const maxDate = formatTanggal(tujuhHariKedepan);
        
        return { min: minDate, max: maxDate };
    }

    // Terapkan pembatasan kalender langsung pada baris pertama (Index 0) pas halaman beres di-load
    window.addEventListener('DOMContentLoaded', () => {
        const batas = dapatkanRentangTanggal();
        const inputTanggalPertama = document.querySelector('input[name="jadwal[0][tanggal]"]');
        if(inputTanggalPertama) {
            inputTanggalPertama.min = batas.min;
            inputTanggalPertama.max = batas.max;
        }
    });
    // ----------------------------------------------------------------------

    // 2. FUNGSI UNTUK MENANGKAP PERUBAHAN PILIHAN GURU (AUTOFILL MAPEL)
    document.getElementById('wrapper-jadwal').addEventListener('change', function(e) {
        if (e.target.classList.contains('select-guru')) {
            const selectGuru = e.target;
            const optionTerpilih = selectGuru.options[selectGuru.selectedIndex];
            
            // Ambil data mapel dari option yang diklik
            const mapelId = optionTerpilih.getAttribute('data-mapel-id');
            const mapelNama = optionTerpilih.getAttribute('data-mapel-nama');
            
            // Cari kontainer pembungkus jadwal-item terdekat
            const parentKard = selectGuru.closest('.jadwal-item');
            
            // Isi otomatis input display nama mapel dan input hidden ID mapelnya
            parentKard.querySelector('.input-mapel-nama').value = mapelNama || '';
            parentKard.querySelector('.input-mapel-id').value = mapelId || '';
        }
    });

    // 3. LOGIC TAMBAH BARIS FORM SECARA DINAMIS
    document.getElementById('btn-tambah-baris').addEventListener('click', function() {
        const wrapper = document.getElementById('wrapper-jadwal');
        const barisBaru = document.createElement('div');
        barisBaru.className = 'jadwal-item bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative mt-4 animated fadeIn';
        
        // Panggil rentang tanggal buat dipasang ke baris baru
        const batas = dapatkanRentangTanggal();

        barisBaru.innerHTML = `
            <button type="button" class="btn-hapus-baris absolute top-4 right-4 text-gray-400 hover:text-red-500 transition" title="Hapus Sesi Ini">
                ✕
            </button>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Pengajar / Guru</label>
                    <select name="jadwal[${barisKe}][user_id]" required class="select-guru w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 font-medium text-sm transition">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $guru) 
                            <option value="{{ $guru->id }}" data-mapel-id="{{ $guru->mapel->id ?? '' }}" data-mapel-nama="{{ $guru->mapel->nama_mapel ?? 'Belum Ada Mapel' }}">{{ $guru->name }}</option> 
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kelas Target</label>
                    <select name="jadwal[${barisKe}][kelas_id]" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 font-medium text-sm transition">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k) <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option> @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Mata Pelajaran</label>
                    <input type="text" readonly placeholder="Pilih guru terlebih dahulu..." class="input-mapel-nama w-full px-4 py-3 bg-gray-100 border border-gray-100 rounded-xl text-gray-500 font-medium text-sm focus:outline-none cursor-not-allowed">
                    <input type="hidden" name="jadwal[${barisKe}][mapel_id]" class="input-mapel-id" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal Pelaksanaan</label>
                    <input type="date" name="jadwal[${barisKe}][tanggal]" min="${batas.min}" max="${batas.max}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Jam Mulai</label>
                    <input type="time" name="jadwal[${barisKe}][jam_mulai]" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Jam Selesai</label>
                    <input type="time" name="jadwal[${barisKe}][jam_selesai]" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 text-gray-800 text-sm transition">
                </div>
            </div>
        `;
        
        wrapper.appendChild(barisBaru);
        barisKe++;
    });

    // 4. EVENT LISTENER UNTUK HAPUS BARIS
    document.getElementById('wrapper-jadwal').addEventListener('click', function(e) {
        if(e.target.classList.contains('btn-hapus-baris')) {
            e.target.parentElement.remove();
        }
    });
</script>
@endsection