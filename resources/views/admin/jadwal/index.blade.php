@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    {{-- Top Header Section --}}
    <div class="max-w-6xl mx-auto flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Data Jadwal Pelajaran</h1>
            <p class="text-sm text-gray-500">Memantau dan mengelola seluruh jadwal belajar-mengajar Averus Bimbel</p>
        </div>
        <div>
            <a href="{{ route('admin.jadwal.create') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm transition transform active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Jadwal Baru
            </a>
        </div>
    </div>

    {{-- Alert Flash Message Sukses --}}
    @if(session('success'))
        <div class="max-w-6xl mx-auto mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl text-sm text-emerald-800 font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- Main Table Card --}}
    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Hari / Waktu</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4">Kelas</th>
                        <th class="px-6 py-4">Pengajar / Guru</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($daftar_jadwal as $jadwal)
                        <tr class="hover:bg-gray-50/80 transition">
                            {{-- Hari & Waktu --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-50 text-indigo-700 mb-1">
                                    {{ $jadwal->hari }}
                                </span>
                                <div class="text-xs font-mono text-gray-500">
                                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }} WIB
                                </div>
                            </td>
                            {{-- Mapel --}}
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $jadwal->mapel->nama_mapel ?? 'Mapel Terhapus' }}
                            </td>
                            {{-- Kelas --}}
                            <td class="px-6 py-4">
                                <div class="text-gray-800 font-medium">{{ $jadwal->kelas->nama_kelas ?? 'Kelas Terhapus' }}</div>
                            </td>
                            {{-- Guru --}}
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $jadwal->guru->name ?? 'Guru Terhapus' }}</div>
                                <div class="text-xs text-gray-400">NIP: {{ $jadwal->guru->nip ?? '-' }}</div>
                            </td>
                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" 
                                    class="inline-flex items-center justify-center w-9 h-9 bg-amber-50 hover:bg-amber-100 text-amber-600 rounded-xl transition transform active:scale-95 shadow-sm border border-amber-200/50" 
                                    title="Edit Jadwal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                        </svg>
                                    </a>      

                                <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Belum ada jadwal pelajaran yang dibuat. Klik tombol di atas untuk menambah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection