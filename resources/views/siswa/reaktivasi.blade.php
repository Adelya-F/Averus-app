@extends('layouts.app')

@section('content')
<div class="min-h-[90vh] flex items-center justify-center p-4">
    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-blue-50">
        
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-10 text-center text-white">
            <div class="text-6xl mb-4">👋</div>
            <h2 class="text-3xl font-extrabold">Senang Melihatmu Lagi!</h2>
            <p class="text-blue-100 mt-3 text-lg">
                Halo <strong>{{ Auth::user()->name }}</strong>, akun kamu saat ini sedang non-aktif. <br>
                Riwayat belajarmu masih tersimpan rapi kok. Mau lanjut belajar lagi?
            </p>
            <div class="mt-4 inline-block bg-white/20 px-4 py-1 rounded-full text-xs font-semibold backdrop-blur-sm">
                Silakan lengkapi data daftar ulang di bawah ini
            </div>
        </div>

        <form action="{{ route('siswa.reaktivasi.ajukan') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1 md:col-span-2">
                    <label class="text-xs font-bold text-gray-500 uppercase ml-1">Asal Sekolah <span class="text-red-500">*</span></label>
                    <input type="text" name="school" value="{{ Auth::user()->school }}" required
                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition bg-gray-50/50"
                        placeholder="Contoh: SMK Negeri 1 Bandung">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase ml-1">Kelas Sekarang <span class="text-red-500">*</span></label>
                    <select name="kelas_id" required 
                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition bg-gray-50/50 shadow-sm">
                        @foreach(\App\Models\Kelas::all() as $k)
                            <option value="{{ $k->id }}" {{ Auth::user()->kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase ml-1">No. WhatsApp Kamu <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone" value="{{ Auth::user()->phone }}" required
                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition bg-gray-50/50"
                        placeholder="08xxxxxxxxxx">
                </div>

                 <div class="space-y-1 md:col-span-2">
                    <label class="text-xs font-bold text-gray-500 uppercase ml-1">No. WhatsApp Orang Tua / Wali <span class="text-red-500">*</span></label>
                    <input type="tel" name="parent_phone" value="{{ Auth::user()->parent_phone }}" required
                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition bg-gray-50/50"
                        placeholder="08xxxxxxxxxx">
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-xs font-bold text-gray-500 uppercase ml-1">Alamat Domisili <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="3" required
                        class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition bg-gray-50/50"
                        placeholder="Tuliskan alamat lengkapmu sekarang...">{{ Auth::user()->address }}</textarea>
                </div>
            </div>

            <div class="pt-4 space-y-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-4 rounded-2xl shadow-xl shadow-blue-200 transition-all transform active:scale-95 flex items-center justify-center gap-3">
                    <span class="text-lg">Aktifkan Akun Saya</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>

                <div class="text-center">
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="text-sm text-gray-400 hover:text-red-500 transition font-medium">
                        Bukan kamu? Keluar akun
                    </a>
                </div>
            </div>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
@endsection