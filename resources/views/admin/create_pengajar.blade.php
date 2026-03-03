<h1 class="text-2xl font-bold mb-4">Tambah Pengajar</h1>

<form method="POST" action="{{ route('admin.pengajar.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Nama" required class="border p-2 w-full mb-3">
    <input type="email" name="email" placeholder="Email" required class="border p-2 w-full mb-3">
    <input type="password" name="password" placeholder="Password" required class="border p-2 w-full mb-3">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>