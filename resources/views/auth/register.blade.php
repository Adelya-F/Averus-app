<x-guest-layout>
    <div class="min-h-screen flex items-start sm:items-center justify-center bg-blue-50 px-4 py-10">

        <div class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl space-y-8">

            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-blue-800">
                    Formulir Pendaftaran Averus College
                </h2>
                <p class="mt-2 text-blue-600">
                    Daftar sekarang dan bergabung bersama kami!
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}"
                class="space-y-6 bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <x-input-label for="name" value="Nama Lengkap" />
                    <x-text-input id="name" class="block mt-1 w-full"
                        type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Sekolah -->
                <div>
                    <x-input-label for="school" value="Sekolah" />
                    <x-text-input id="school" class="block mt-1 w-full"
                        type="text" name="school" :value="old('school')" required />
                </div>

                <!-- Kelas -->
                <div>
                    <x-input-label for="class" value="Kelas" />
                    <select name="class" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Pilih Kelas</option>
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
                </div>

                <!-- Hobi -->
                <div>
                    <x-input-label for="hobby" value="Hobi" />
                    <x-text-input id="hobby" class="block mt-1 w-full"
                        type="text" name="hobby" :value="old('hobby')" />
                </div>

                <!-- Alamat -->
                <div>
                    <x-input-label for="address" value="Alamat Lengkap" />
                    <textarea name="address" rows="3"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('address') }}</textarea>
                </div>

                <!-- No HP -->
                <div>
                    <x-input-label for="phone" value="No HP / WhatsApp" />
                    <x-text-input id="phone" class="block mt-1 w-full"
                        type="text" name="phone" :value="old('phone')" required />
                </div>

                <!-- Nama Orang Tua -->
                <div>
                    <x-input-label for="parent_name" value="Nama Ayah / Ibu" />
                    <x-text-input id="parent_name" class="block mt-1 w-full"
                        type="text" name="parent_name" :value="old('parent_name')" required />
                </div>

                <!-- No HP Orang Tua -->
                <div>
                    <x-input-label for="parent_phone" value="No HP / WA Ayah / Ibu" />
                    <x-text-input id="parent_phone" class="block mt-1 w-full"
                        type="text" name="parent_phone" :value="old('parent_phone')" required />
                </div>

                <!-- Mapel Disukai -->
                <div>
                    <x-input-label for="favorite_subject" value="Mapel yang Disukai (boleh lebih dari 1)" />
                    <x-text-input id="favorite_subject" class="block mt-1 w-full"
                        type="text" name="favorite_subject"
                        placeholder="Contoh: Matematika, Bahasa Inggris" />
                </div>

                <!-- Instagram -->
                <div>
                    <x-input-label for="instagram" value="Instagram" />
                    <x-text-input id="instagram" class="block mt-1 w-full"
                        type="text" name="instagram" :value="old('instagram')" />
                </div>

                <!-- TikTok -->
                <div>
                    <x-input-label for="tiktok" value="TikTok" />
                    <x-text-input id="tiktok" class="block mt-1 w-full"
                        type="text" name="tiktok" :value="old('tiktok')" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password" name="password" required />
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password" name="password_confirmation" required />
                </div>

                <input type="hidden" name="role" value="siswa">

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mt-6">
                    <a class="text-sm text-blue-600 underline text-center sm:text-left" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>

                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 w-full sm:w-auto">
                        Daftar
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>