@extends('layouts.app') 

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Jadwal Averus</h2>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Jadwal
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-4 border">No</th>
                    <th class="py-3 px-4 border">Hari</th>
                    <th class="py-3 px-4 border">Tanggal</th>
                    <th class="py-3 px-4 border">Jam</th>
                    <th class="py-3 px-4 border">Mapel</th>
                    <th class="py-3 px-4 border">Pengajar</th>
                    <th class="py-3 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $key => $item)
                <tr class="hover:bg-gray-50 text-center">
                    <td class="py-3 px-4 border">{{ $key + 1 }}</td>
                    <td class="py-3 px-4 border">{{ $item->hari }}</td>
                    <td class="py-3 px-4 border">{{ $item->tanggal }}</td>
                    <td class="py-3 px-4 border">{{ $item->jam }}</td>
                    <td class="py-3 px-4 border">{{ $item->mapel }}</td>
                    <td class="py-3 px-4 border">{{ $item->pengajar }}</td>
                    <td class="py-3 px-4 border">
                        <div class="flex gap-2 justify-center">
                            <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">Edit</button>
                            
                            <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.jadwal.update', $item->id) }}" method="POST" class="modal-content">
                            @csrf @method('PUT')
                            <div class="modal-header"><h5>Edit Jadwal</h5></div>
                            <div class="modal-body text-left">
                                <input type="text" name="guru" value="{{ $item->guru }}" class="form-control mb-2" required>
                                <input type="text" name="hari" value="{{ $item->hari }}" class="form-control mb-2" required>
                                <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control mb-2" required>
                                <input type="text" name="jam" value="{{ $item->jam }}" class="form-control mb-2" required>
                                <input type="text" name="mapel" value="{{ $item->mapel }}" class="form-control mb-2" required>
                                <input type="text" name="pengajar" value="{{ $item->pengajar }}" class="form-control mb-2" required>
                            </div>
                            <div class="modal-footer"><button class="btn btn-primary">Simpan Perubahan</button></div>
                        </form>
                    </div>
                </div>
                @empty
                <tr><td colspan="8" class="py-10 text-center text-gray-500 italic">Belum ada jadwal tersedia.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.jadwal.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5>Tambah Jadwal Baru</h5></div>
            <div class="modal-body">
                <input type="text" name="hari" placeholder="Hari" class="form-control mb-2" required>
                <input type="date" name="tanggal" class="form-control mb-2" required>
                <input type="text" name="jam" placeholder="Jam (Contoh: 08:00 - 10:00)" class="form-control mb-2" required>
                <input type="text" name="mapel" placeholder="Mata Pelajaran" class="form-control mb-2" required>
                <input type="text" name="pengajar" placeholder="Pengajar" class="form-control mb-2" required>
            </div>
            <div class="modal-footer"><button class="btn btn-primary w-full">Simpan Jadwal</button></div>
        </form>
    </div>
</div>
@endsection