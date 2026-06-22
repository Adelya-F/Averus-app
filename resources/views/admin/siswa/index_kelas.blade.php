@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header Halaman --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Siswa Per Kelas</h2>
            <p class="text-sm text-gray-500 mt-1">Pilih folder atau gunakan tombol cepat untuk mengirim undangan kenaikan kelas.</p>
        </div>

        <a href="{{ route('admin.kelas.index') }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-50 transition shadow-sm text-sm font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Kelola Kategori Kelas
        </a>
    </div>

    {{-- Grid Folder Kelas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($daftar_kelas as $kelas)
            <div class="group relative bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-300 transition-all duration-300">
                
                {{-- Tombol Kirim Undangan Global (Pojok Kanan Atas) --}}
                @if($kelas->next_class_id)
                <form action="{{ route('admin.siswa.kirim-undangan.index', $kelas->id) }}" method="POST" class="absolute top-4 right-4 z-10" onsubmit="return confirm('Kirim undangan kenaikan ke SEMUA siswa di {{ $kelas->nama_kelas }}?')">
                    @csrf
                    <button type="submit" class="p-2 bg-green-50 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition shadow-sm" title="Kirim Undangan Kenaikan Kelas">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </button>
                </form>
                @endif

                <a href="{{ route('admin.siswa.show', $kelas->slug) }}" class="block">
                    {{-- Icon Folder --}}
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </div>

                    {{-- Info Kelas --}}
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-gray-800 uppercase group-hover:text-blue-600 transition-colors">
                            {{ $kelas->nama_kelas }}
                        </h3>
                        <div class="flex items-center gap-2 text-gray-500">
                            <span class="text-xs font-semibold bg-gray-100 px-2 py-0.5 rounded text-gray-600 italic">
                                {{ $kelas->slug }}
                            </span>
                            <span class="text-gray-300">•</span>
                            <p class="text-sm font-medium">{{ $kelas->users_count }} Siswa</p>
                        </div>
                    </div>

                    {{-- Badge Indikator Kenaikan --}}
                    @if($kelas->next_class_id)
                        <div class="mt-4 pt-4 border-t border-gray-50 flex items-center gap-1 text-[10px] font-bold text-green-600 uppercase tracking-wider">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            Naik ke: {{ $kelas->nextClass->nama_kelas ?? '...' }}
                        </div>
                    @else
                        <div class="mt-4 pt-4 border-t border-gray-50 flex items-center gap-1 text-[10px] font-bold text-indigo-600 uppercase tracking-wider">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Target: Kelulusan (Alumni)
                        </div>
                    @endif
                </a>
            </div>
        @empty
            <div class="col-span-full bg-white p-12 rounded-2xl border border-dashed border-gray-200 text-center">
                <h3 class="text-gray-500 font-medium">Belum ada kategori kelas</h3>
            </div>
        @endforelse
    </div>
</div>
@endsection