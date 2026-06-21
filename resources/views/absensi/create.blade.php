@extends('layouts.app')

@section('content')

<div class="container mt-4">
<h2>Tambah Absensi</h2>

<form action="{{ route('absensi.store') }}" method="POST">
@csrf

<input type="text" name="nama_siswa" class="form-control mb-2" placeholder="Nama Siswa">

<input type="text" name="kelas" class="form-control mb-2" placeholder="Kelas">

<input type="date" name="tanggal" class="form-control mb-2">

<select name="status" class="form-control mb-2">
    <option value="hadir">Hadir</option>
    <option value="izin">Izin</option>
    <option value="sakit">Sakit</option>
    <option value="alpha">Alpha</option>
</select>

<button class="btn btn-success">Simpan</button>

</form>

</div>

@endsection