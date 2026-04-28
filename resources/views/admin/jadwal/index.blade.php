@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Jadwal Belajar Averus</h1>
        @if(auth()->user()->role == 'admin')
            <button onclick="document.getElementById('modalJadwal').classList.remove('hidden')" 
                class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg">
                + Buat Jadwal Baru
            </button>
        @endif
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <table class="w-full text-left">
            <thead class="bg-indigo-50 text-indigo-700 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Waktu</th>
                    <th class="px-6 py-4">Mata Pelajaran</th>
                    <th class="px-6 py-4">Guru</th>
                    <th class="px-6 py-4">Siswa</th>
                    @if(auth()->user()->role == 'admin') <th class="px-6 py-4 text-center">Aksi</th> @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($jadwals as $j)
                <tr class="hover:bg-indigo-50/30 transition">
                    <td class="px-6 py-4">
                        <span class="block font-bold text-gray-800">{{ $j->hari }}</span>
                        <span class="text-xs text-gray-500">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">{{ $j->mapel->nama_mapel }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $j->guru->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $j->siswa->name }}</td>
                    @if(auth()->user()->role == 'admin')
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="modalJadwal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl">
        <h2 class="text-xl font-bold mb-6">Tambah Jadwal Baru</h2>
        <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-bold text-gray-500 uppercase">Pilih Guru</label>
                <select name="user_id" class="w-full border-gray-200 rounded-xl" required>
                    @foreach($gurus as $g) <option value="{{ $g->id }}">{{ $g->name }}</option> @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-bold text-gray-500 uppercase">Pilih Siswa</label>
                <select name="siswa_id" class="w-full border-gray-200 rounded-xl" required>
                    @foreach($siswas as $s) <option value="{{ $s->id }}">{{ $s->name }}</option> @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-bold text-gray-500 uppercase">Mata Pelajaran</label>
                <select name="mapel_id" class="w-full border-gray-200 rounded-xl" required>
                    @foreach($mapels as $m) <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option> @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase">Hari</label>
                    <select name="hari" class="w-full border-gray-200 rounded-xl">
                        @foreach($hari_list as $h) <option value="{{ $h }}">{{ $h }}</option> @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-500 uppercase">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="w-full border-gray-200 rounded-xl" required>
                </div>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="document.getElementById('modalJadwal').classList.add('hidden')" class="flex-1 py-3 text-gray-500 font-bold">Batal</button>
                <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-md">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection