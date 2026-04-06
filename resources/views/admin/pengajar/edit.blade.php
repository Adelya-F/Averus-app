<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengajar - Averus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--default .select2-selection--multiple {
            border-radius: 0.75rem !important;
            border-color: #e5e7eb !important;
            padding: 5px !important;
        }
        .select2-container--default .select2-selection__choice {
            background-color: #6366f1 !important;
            color: white !important;
            border-radius: 0.5rem !important;
        }
    </style>
</head>

<body class="bg-stone-50 min-h-screen">

    <header class="bg-gradient-to-r from-indigo-500 via-blue-500 to-purple-500 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center gap-4">
            <a href="{{ route('admin.pengajar') }}"
            class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-xl text-white">
                ←
            </a>
            <h1 class="text-white text-xl font-bold">
                Edit Pengajar
            </h1>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-6 py-12">

    <div class="bg-white rounded-2xl shadow-xl p-8">

    @if ($errors->any())
    <div class="mb-6 bg-red-100 text-red-600 p-4 rounded">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <form method="POST" action="{{ route('admin.pengajar.update', $pengajar->id) }}">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-6">

    <div>
    <label>NIP</label>
    <input type="text" name="nip"
    value="{{ old('nip', $pengajar->nip) }}"
    class="w-full border rounded-lg px-3 py-2">
    </div>

    <div>
    <label>Nama</label>
    <input type="text" name="name"
    value="{{ old('name', $pengajar->name) }}"
    class="w-full border rounded-lg px-3 py-2">
    </div>

    <div>
    <label>Email</label>
    <input type="email" name="email"
    value="{{ old('email', $pengajar->email) }}"
    class="w-full border rounded-lg px-3 py-2">
    </div>

    <div>
    <label>Password (opsional)</label>
    <input type="password" name="password"
    placeholder="Kosongkan jika tidak diubah"
    class="w-full border rounded-lg px-3 py-2">
    </div>

    <div>
    <label>No HP</label>
    <input type="text" name="phone"
    value="{{ old('phone', $pengajar->phone) }}"
    class="w-full border rounded-lg px-3 py-2">
    </div>

    <div>
    <label>Mata Pelajaran</label>
    <select name="mata_pelajaran[]" id="mapel" multiple class="w-full">

    @php
    $selected = explode(',', $pengajar->mata_pelajaran ?? '');
    @endphp

    @foreach($mapels as $mapel)
    <option value="{{ $mapel->nama_mapel }}"
    @if(in_array($mapel->nama_mapel, $selected)) selected @endif>
    {{ $mapel->nama_mapel }}
    </option>
    @endforeach

    </select>
    </div>

    <div>
    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir"
    value="{{ old('tanggal_lahir', $pengajar->tanggal_lahir) }}"
    class="w-full border rounded-lg px-3 py-2">
    </div>

    <div>
    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" class="w-full border rounded-lg px-3 py-2">
    <option value="">Pilih</option>
    <option value="Laki-laki" {{ $pengajar->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
    <option value="Perempuan" {{ $pengajar->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>
    </div>

    </div>

    <div class="mt-6">
    <label>Alamat</label>
    <textarea name="address" class="w-full border rounded-lg px-3 py-2">{{ old('address', $pengajar->address) }}</textarea>
    </div>

    <div class="mt-8 flex justify-between">
    <a href="{{ route('admin.pengajar') }}" class="text-gray-600">
    ← Kembali
    </a>

    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg">
    Update
    </button>
    </div>

    </form>

    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $('#mapel').select2({
        placeholder: "Pilih mapel"
    });
    </script>

    </body>
    </html>