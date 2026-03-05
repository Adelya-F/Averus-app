@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Jadwal Baru</h2>
    <form action="{{ route('admin.jadwal.store') }}" method="POST">
        @csrf
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
            <input type="text" name="jam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mapel</label>
            <input type="text" name="mapel" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Pengajar</label>
            <input type="text" name="pengajar" class="form-control" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection