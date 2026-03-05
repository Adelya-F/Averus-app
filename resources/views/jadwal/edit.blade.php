@extends('layouts.app')

@section('content')
<div class="container mt-4">
<h2>Edit Jadwal</h2>

<form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
@csrf
@method('PUT')

<input type="text" name="guru" value="{{ $jadwal->guru }}" class="form-control mb-2">
<input type="text" name="hari" value="{{ $jadwal->hari }}" class="form-control mb-2">
<input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" class="form-control mb-2">
<input type="text" name="jam" value="{{ $jadwal->jam }}" class="form-control mb-2">
<input type="text" name="mapel" value="{{ $jadwal->mapel }}" class="form-control mb-2">
<input type="text" name="pengajar" value="{{ $jadwal->pengajar }}" class="form-control mb-2">

<button class="btn btn-warning">Update</button>
</form>

</div>
@endsection