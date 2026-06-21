
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas {{ $kelas->nama_kelas }} - Averus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

<div class="p-6">
    {{-- Header Utama dengan Tombol Back --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.siswa.index') }}" 
               class="w-10 h-10 flex items-center justify-center bg-white rounded-xl border border-gray-200 shadow-sm text-gray-600 hover:text-indigo-600 hover:border-indigo-100 transition transform active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $kelas->nama_kelas }}</h1>
                <p class="text-gray-500 text-sm">Data Lengkap Profil & Kontak Siswa.</p>
            </div>
        </div>
        
        {{-- Form Pencarian Nama --}}
        <div class="flex flex-wrap gap-3">
            <form action="" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama..." 
                       class="pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none text-sm w-64">
                <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </form>
        </div>
    </div>

    {{-- Tabel Data Super Lengkap --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[1800px]">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Nama Siswa</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Sekolah Asal</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">WA Siswa</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">WA Ortu</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Nama Ortu</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Alamat</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">TTL & Gender</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Hobi & Mapel Fav</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Sosmed</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($siswa as $s)
                    <tr class="hover:bg-blue-50/20 transition-colors">
                        {{-- Nama & Email --}}
                        <td class="px-6 py-5">
                            <div class="font-bold text-gray-800">{{ $s->name }}</div>
                            <div class="text-[10px] text-gray-400 italic">{{ $s->email }}</div>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-5">
                            @if($s->status == 'pending')
                                <span class="bg-amber-100 text-amber-600 px-2 py-1 rounded text-[10px] font-bold uppercase">Pending</span>
                            @elseif($s->status == 'accepted')
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-[10px] font-bold uppercase">Active</span>
                            @else
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-[10px] font-bold uppercase">Inactive</span>
                            @endif
                        </td>

                        {{-- Sekolah Asal --}}
                        <td class="px-6 py-5 text-gray-600">{{ $s->school ?? '-' }}</td>

                        {{-- Kontak --}}
                        <td class="px-6 py-5 font-medium text-blue-600">{{ $s->phone ?? '-' }}</td>
                        <td class="px-6 py-5 font-medium text-indigo-600">{{ $s->parent_phone ?? '-' }}</td>
                        <td class="px-6 py-5 text-gray-600">{{ $s->parent_name ?? '-' }}</td>

                        {{-- Alamat --}}
                        <td class="px-6 py-5">
                            <div class="max-w-[200px] truncate" title="{{ $s->address }}">{{ $s->address ?? '-' }}</div>
                        </td>

                        {{-- TTL & Gender --}}
                        <td class="px-6 py-5">
                            <div class="text-xs">{{ $s->tanggal_lahir ? \Carbon\Carbon::parse($s->tanggal_lahir)->format('d/m/Y') : '-' }}</div>
                            <div class="text-[10px] text-gray-400 uppercase">{{ $s->jenis_kelamin ?? '-' }}</div>
                        </td>

                        {{-- Hobi & Mapel --}}
                        <td class="px-6 py-5">
                            <div class="text-xs">🏀 {{ $s->hobby ?? '-' }}</div>
                            <div class="text-xs">📚 {{ $s->favorite_subject ?? '-' }}</div>
                        </td>

                        {{-- Sosmed --}}
                        <td class="px-6 py-5">
                            <div class="text-[10px]">IG: {{ $s->instagram ?? '-' }}</div>
                            <div class="text-[10px]">TT: {{ $s->tiktok ?? '-' }}</div>
                        </td>

                        {{-- Aksi Berhenti & Edit --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.siswa.edit', $s->id) }}" 
                                   class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition inline-block">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </a>
                                
                                <form action="{{ route('admin.siswa.berhenti', $s->id) }}" method="POST" onsubmit="return confirm('Berhentikan siswa ini?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-600 hover:text-white transition uppercase">
                                        Berhenti
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data siswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

