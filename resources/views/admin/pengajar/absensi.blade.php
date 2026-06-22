@extends('layouts.app')

@section('content')

<div class="p-8">

<h1 class="text-2xl font-bold">
Absensi Pengajar
</h1>


<form action="{{ route('pengajar.absensi.store') }}" method="POST">

@csrf

<button class="bg-blue-500 text-white px-5 py-2 rounded">

Absen Masuk

</button>

</form>


<table class="mt-5 w-full border">

<tr>
<th class="border p-2">Tanggal</th>
<th class="border p-2">Jam</th>
<th class="border p-2">Status</th>
</tr>


@foreach($absensis as $absen)

<tr>

<td class="border p-2">
{{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}
</td>

<td class="border p-2">
{{ $absen->jam_masuk
    ? \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i')
    : '-' }}
</td>

<td class="border p-2">
{{ $absen->status }}
</td>

</tr>

@endforeach


</table>


</div>

@endsection