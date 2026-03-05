@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-start sm:items-center justify-center bg-blue-50 px-4 py-5">

        <div class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl space-y-8">

            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-blue-800">
                    Form Tambah Pengajar
                </h2>
                <p class="mt-2 text-blue-600">
                    Silakan isi data pengajar dengan lengkap.
                </p>
            </div>

            <form method="POST"
                action="{{ route('admin.pengajar.store') }}"
                class="space-y-6 bg-white p-6 sm:p-8 rounded-xl shadow-lg">

                @csrf

                <!-- NIP -->
                <div>
                    <x-input-label for="nip" value="NIP" />
                    <x-text-input id="nip" class="block mt-1 w-full"
                        type="text" name="nip" :value="old('nip')" required />
                    <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                </div>

                <!-- Nama -->
                <div>
                    <x-input-label for="nama" value="Nama Lengkap" />
                    <x-text-input id="nama" class="block mt-1 w-full"
                        type="text" name="nama" :value="old('nama')" required />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- No HP -->
                <div>
                    <x-input-label for="phone" value="No HP / WhatsApp" />
                    <x-text-input id="phone" class="block mt-1 w-full"
                        type="text" name="phone" :value="old('phone')" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                    <x-text-input id="tanggal_lahir" class="block mt-1 w-full"
                        type="date" name="tanggal_lahir" required />
                    <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                    <select name="jenis_kelamin"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                </div>

                <!-- Alamat -->
                <div>
                    <x-input-label for="address" value="Alamat Lengkap" />
                    <textarea name="address" rows="3"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mt-6">

                    <a href="{{ route('admin.pengajar') }}"
                        class="text-sm text-blue-600 underline text-center sm:text-left">
                        Kembali ke Daftar Pengajar
                    </a>

                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 w-full sm:w-auto">
                        Simpan Data
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
@endsection