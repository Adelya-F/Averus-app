@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    {{-- Header Section --}}
    <div class="max-w-3xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Jadwal Pelajaran</h1>
            <p class="text-sm text-gray-500">Ubah detail jadwal belajar-mengajar Averus Bimbel</p>
        </div>
        <div>
            <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition">
                ← Kembali ke Daftar
            </a>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8">
        <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Pilih Guru --}}
            <div>
                <label for="user_id" class="block text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Pengajar / Guru</label>
                <select name="user_id" id="user_id" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 focus:bg-white text-gray-800 font-medium transition">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}" {{ old('user_id', $jadwal->user_id) == $guru->id ? 'selected' : '' }}>
                            {{ $guru->name }} ({{ $guru->mapel->nama_mapel ?? 'Mapel Tidak Set' }})
                        </option>
                    @endforeach
                </select>
                @error('user_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            {{-- Pilih Kelas --}}
            <div>
                <label for="kelas_id" class="block text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Kelas</label>
                <select name="kelas_id" id="kelas_id" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 focus:bg-white text-gray-800 font-medium transition">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id', $jadwal->kelas_id) == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
                @error('kelas_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            {{-- Pilih Mata Pelajaran --}}
            <div>
                <label for="mapel_id" class="block text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Mata Pelajaran</label>
                <select name="mapel_id" id="mapel_id" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 focus:bg-white text-gray-900 font-semibold transition">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach($gurus->pluck('mapel')->unique('id')->filter() as $mapel)
                        <option value="{{ $mapel->id }}" {{ old('mapel_id', $jadwal->mapel_id) == $mapel->id ? 'selected' : '' }}>
                            {{ $mapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
                @error('mapel_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            {{-- Hari, Jam Mulai, Jam Selesai --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="hari" class="block text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Hari</label>
                    <select name="hari" id="hari" required
                        class="w-full px-4 py-3 bg-indigo-50 border border-transparent rounded-xl focus:outline-none focus:border-indigo-500 focus:bg-white text-indigo-700 font-semibold transition">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $h)
                            <option value="{{ $h }}" {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                    @error('hari') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jam_mulai" class="block text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="jam_mulai" required
                        value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 focus:bg-white text-gray-500 font-mono transition">
                    @error('jam_mulai') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jam_selesai" class="block text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" required
                        value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-indigo-500 focus:bg-white text-gray-500 font-mono transition">
                    @error('jam_selesai') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="pt-6 flex items-center justify-end gap-3 border-t border-gray-100">
                <a href="{{ route('admin.jadwal.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-500 hover:text-gray-700 transition">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm transition transform active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection