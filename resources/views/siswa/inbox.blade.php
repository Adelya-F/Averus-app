@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kotak Masuk</h2>

    <div class="space-y-4">
        @forelse($messages as $msg)
            <div class="p-5 rounded-2xl border {{ $msg->is_read ? 'bg-white border-gray-100' : 'bg-blue-50 border-blue-100' }} shadow-sm transition">
                <div class="flex justify-between items-center">
                    <div class="flex-1">
                        <h3 class="font-bold {{ $msg->is_read ? 'text-gray-700' : 'text-blue-700' }}">
                            {{ $msg->title }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $msg->message }}</p>
                        <span class="text-[10px] text-gray-400 uppercase mt-2 block italic">
                            {{ $msg->created_at->diffForHumans() }}
                        </span>
                    </div>

                    {{-- Kontainer Tombol --}}
                    <div class="flex items-center gap-3 ml-4">
                        @if($msg->type === 'promotion' && !$msg->is_confirmed)
                            {{-- Tombol Terima --}}
                            <form action="{{ route('siswa.inbox.konfirmasi', $msg->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-md transition whitespace-nowrap">
                                    Terima Kenaikan Kelas
                                </button>
                            </form>

                            {{-- Tombol Berhenti (Baru) --}}
                            <form action="{{ route('siswa.inbox.berhenti', $msg->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin berhenti? Akun kamu akan menjadi tidak aktif.')">
                                @csrf
                                <button type="submit" class="bg-white border border-red-500 text-red-500 hover:bg-red-50 px-4 py-2 rounded-xl text-sm font-bold transition whitespace-nowrap">
                                    Berhenti
                                </button>
                            </form>

                        @elseif($msg->is_confirmed)
                            <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-lg text-xs font-bold whitespace-nowrap">
                                ✓ Berhasil Dikonfirmasi
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-10 bg-white rounded-2xl border border-dashed">
                <p class="text-gray-400">Tidak ada pesan masuk.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection