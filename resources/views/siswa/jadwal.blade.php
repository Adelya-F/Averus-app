@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-2xl font-bold mb-4">Jadwal Lengkap</h2>

    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Mapel</th>
                <th>Pengajar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->hari ?? '-' }}</td>
                <td>{{ $item->tanggal ?? '-' }}</td>
                <td>{{ $item->jam ?? '-' }}</td>
                <td>{{ $item->mapel ?? '-' }}</td>
                <td>{{ $item->pengajar ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Belum ada jadwal tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection