@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">📋 Absensi Siswa</h2>

    {{-- NOTIF --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- TOMBOL ABSEN --}}
    <div class="card p-4 mb-4 text-center shadow-sm">
        <h5>Waktu Sekarang</h5>
        <h3>{{ now()->format('d-m-Y H:i:s') }}</h3>

        <form action="{{ route('siswa.absen.store') }}" method="POST">
            @csrf
            <button class="btn btn-success mt-3">
                ✅ Absen Sekarang
            </button>
        </form>
    </div>

    {{-- RIWAYAT --}}
    <div class="card p-4 shadow-sm">
        <h4>📊 Riwayat Absensi</h4>

        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal & Jam</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensis as $i => $absen)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Belum ada absensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection