@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Jadwal</h2>

    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" value="{{ old('hari', $jadwal->hari) }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $jadwal->tanggal) }}" required>
        </div>

        <div class="mb-3">
            <label>Jam</label>
            <input type="text" name="jam" class="form-control" value="{{ old('jam', $jadwal->jam) }}" required>
        </div>

        <div class="mb-3">
            <label>Mapel</label>
            <input type="text" name="mapel" class="form-control" value="{{ old('mapel', $jadwal->mapel) }}" required>
        </div>

        <div class="mb-3">
            <label>Pengajar</label>
            <input type="text" name="pengajar" class="form-control" value="{{ old('pengajar', $jadwal->pengajar) }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection