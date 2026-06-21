@extends('layouts.app')

@section('content')

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">
    <h2>Data Absensi</h2>
    <a href="{{ route('absensi.create') }}" class="btn btn-success">
        + Tambah Absensi
    </a>
</div>

<table class="table table-bordered text-center">
    <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    @foreach($absensis as $i => $a)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $a->nama_siswa }}</td>
        <td>{{ $a->kelas }}</td>
        <td>{{ $a->tanggal }}</td>
        <td>{{ $a->status }}</td>
        <td>
            <form action="{{ route('absensi.destroy',$a->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

</div>

@endsection