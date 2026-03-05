@extends('layouts.app')

@section('content')
<div class="container mt-4">
<h2>Tambah Jadwal</h2>

<form action="{{ route('jadwal.store') }}" method="POST">
@csrf

<input type="text" name="guru" class="form-control mb-2" placeholder="Guru">
<input type="text" name="hari" class="form-control mb-2" placeholder="Hari">
<input type="date" name="tanggal" class="form-control mb-2">
<input type="text" name="jam" class="form-control mb-2" placeholder="Jam">
<input type="text" name="mapel" class="form-control mb-2" placeholder="Mapel">
<input type="text" name="pengajar" class="form-control mb-2" placeholder="Pengajar">

<button class="btn btn-success">Simpan</button>
</form>

</div>
@endsection