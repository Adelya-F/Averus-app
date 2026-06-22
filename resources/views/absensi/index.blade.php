@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

<h1 class="text-2xl font-bold mb-6">
    Absensi Siswa
</h1>


<div class="bg-white rounded-3xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-indigo-50">

<tr>
<th class="p-4">No</th>
<th class="p-4">Siswa</th>
<th class="p-4">Guru</th>
<th class="p-4">Tanggal</th>
<th class="p-4">Aksi</th>
</tr>

</thead>


<tbody>

@foreach($absensis as $a)

<tr class="border-t">

<td class="p-4">
{{ $loop->iteration }}
</td>


<td class="p-4">
{{ $a->user->name }}
</td>


<td class="p-4">
{{ $a->guru->name ?? '-' }}
</td>


<td class="p-4">
{{ $a->tanggal }}
</td>


<td class="p-4">

<form action="{{ route('admin.absensi.destroy',$a->id) }}"
method="POST">

@csrf
@method('DELETE')

<button class="text-red-500">
Hapus
</button>

</form>

</td>

</tr>

@endforeach


</tbody>

</table>

</div>

</div>

@endsection