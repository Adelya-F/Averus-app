@extends('layouts.app')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Data Pengajar</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.pengajar.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
       + Tambah Pengajar
    </a>

    <table class="w-full mt-4 border border-gray-300">
        <thead class="bg-blue-700 text-white">
            <tr>
                <th class="p-2 text-left">Nama</th>
                <th class="p-2 text-left">Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajar as $data)
                <tr class="border-b">
                    <td class="p-2">{{ $data->name }}</td>
                    <td class="p-2">{{ $data->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="p-4 text-center text-gray-500">
                        Belum ada data pengajar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection