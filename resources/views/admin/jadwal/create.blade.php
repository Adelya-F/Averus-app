@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Jadwal</h2>

    <form action="{{ route('admin.jadwal.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Guru</label>
            <input type="text" name="guru" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam</label>
            <input type="text" name="jam" class="form-control" placeholder="08:00 - 10:00" required>
        </div>

        <div class="mb-3">
            <label>Mapel</label>
            <input type="text" name="mapel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pengajar</label>
            <input type="text" name="pengajar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection