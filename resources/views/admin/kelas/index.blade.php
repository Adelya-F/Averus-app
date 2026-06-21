@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Manajemen Kategori Kelas</h2>
    </div>

    {{-- Form Tambah Kelas Baru --}}
    <div class="bg-white p-6 rounded-xl shadow-sm mb-8 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Tambah Kelas Baru</h3>
        <form action="{{ route('admin.kelas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            <div class="md:col-span-1">
                <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Nama Kelas</label>
                <input type="text" name="nama_kelas" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none transition"
                    placeholder="Contoh: 10 SMA" required>
            </div>

            <div class="md:col-span-1">
                <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Target Kenaikan Ke:</label>
                <select name="next_class_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none transition">
                    <option value="">-- Kelulusan (Alumni) --</option>
                    @foreach($all_kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-1 flex items-end">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition shadow-md">
                    + Tambah Kelas
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Daftar Kelas --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Nama Kelas</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Alur Kenaikan</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600">Jumlah Siswa</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($all_kelas as $kelas)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="text-gray-700 font-medium">{{ $kelas->nama_kelas }}</div>
                        <div class="text-gray-400 text-xs">{{ $kelas->slug }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($kelas->next_class_id)
                            <span class="text-sm text-green-600 font-medium flex items-center gap-1">
                                ➔ {{ $kelas->nextClass->nama_kelas ?? 'Kelas Tujuan' }}
                            </span>
                        @else
                            <span class="text-sm text-indigo-500 font-medium">🎓 Kelulusan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                            {{ $kelas->users_count }} Siswa
                        </span>
                    </td>
                    <td class="px-6 py-4 flex justify-center gap-3">
                        {{-- Kamu bisa tambah tombol edit di sini nanti --}}
                        
                        <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                        Belum ada data kelas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection