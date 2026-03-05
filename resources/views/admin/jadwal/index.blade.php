@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Jadwal Lengkap</h2>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-success">+ Tambah Jadwal</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Guru</th>
                <th>Hari</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Mapel</th>
                <th>Pengajar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $index => $jadwal)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jadwal->guru ?? '-' }}</td>
                <td>{{ $jadwal->hari ?? '-' }}</td>
                <td>{{ $jadwal->tanggal ?? '-' }}</td>
                <td>{{ $jadwal->jam ?? '-' }}</td>
                <td>{{ $jadwal->mapel ?? '-' }}</td>
                <td>{{ $jadwal->pengajar ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Belum ada jadwal tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection