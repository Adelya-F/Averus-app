<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen p-6">

    <h1 class="text-2xl font-bold mb-6 text-blue-700">
        Data Siswa Averus
    </h1>

    <div class="bg-white shadow rounded-xl overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Sekolah</th>
                    <th class="px-4 py-3">Kelas</th>
                    <th class="px-4 py-3">No HP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $data)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $data->name }}</td>
                    <td class="px-4 py-2">{{ $data->email }}</td>
                    <td class="px-4 py-2">{{ $data->school }}</td>
                    <td class="px-4 py-2">{{ $data->class }}</td>
                    <td class="px-4 py-2">{{ $data->phone }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
           Kembali ke Dashboard
        </a>
    </div>

</body>
</html>