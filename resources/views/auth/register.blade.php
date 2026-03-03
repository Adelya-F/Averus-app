<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-blue-50 px-4 sm:px-6 lg:px-8 py-10">

        <div class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl space-y-8">

            <div class="text-center">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-blue-800">
                    Pendaftaran Siswa Averus
                </h2>
                <p class="mt-2 text-sm sm:text-base text-blue-600">
                    Daftar sekarang dan bergabung di Bimbel Averus!
                </p>
            </div>

            <form class="space-y-6 bg-white p-6 sm:p-8 md:p-10 rounded-xl shadow-lg"
                  method="POST"
                  action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name"
                        class="block mt-1 w-full border-blue-300 focus:ring-blue-500 focus:border-blue-500"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required autofocus
                        placeholder="Masukkan nama lengkap" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-blue-300 focus:ring-blue-500 focus:border-blue-500"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        placeholder="contoh: siswa@averus.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <x-input-label for="phone" :value="__('Nomor Telepon')" />
                    <x-text-input id="phone"
                        class="block mt-1 w-full border-blue-300 focus:ring-blue-500 focus:border-blue-500"
                        type="text"
                        name="phone"
                        :value="old('phone')"
                        required
                        placeholder="08123456789" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-blue-300 focus:ring-blue-500 focus:border-blue-500"
                        type="password"
                        name="password"
                        required
                        placeholder="Minimal 8 karakter" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full border-blue-300 focus:ring-blue-500 focus:border-blue-500"
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Ulangi password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Kelas -->
                <div>
                    <x-input-label for="class" :value="__('Kelas')" />
                    <select id="class" name="class"
                        class="block mt-1 w-full border-blue-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="" disabled selected>Pilih kelas</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="SD {{ $i }}">SD {{ $i }}</option>
                        @endfor
                        @for ($i = 7; $i <= 9; $i++)
                            <option value="SMP {{ $i }}">SMP {{ $i }}</option>
                        @endfor
                        @for ($i = 10; $i <= 12; $i++)
                            <option value="SMA {{ $i }}">SMA {{ $i }}</option>
                        @endfor
                    </select>
                    <x-input-error :messages="$errors->get('class')" class="mt-2" />
                </div>

                <input type="hidden" name="role" value="siswa">

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
                    <a class="text-sm text-blue-600 hover:text-blue-800 underline"
                       href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>

                    <x-primary-button class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700">
                        Daftar
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>