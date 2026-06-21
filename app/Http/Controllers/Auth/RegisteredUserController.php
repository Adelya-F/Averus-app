<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inbox; 
use App\Models\Kelas; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $daftar_kelas = Kelas::all();
        return view('auth.register', compact('daftar_kelas'));
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'kelas_id' => ['required', 'exists:kelas,id'], // 🔥 Ganti 'class' jadi 'kelas_id'
            'school' => ['required', 'string', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'hobby' => ['nullable', 'string', 'max:255'],
            'favorite_subject' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
        ]);

        // 2. Simpan data ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'kelas_id' => $request->kelas_id, 
            'school' => $request->school,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'address' => $request->address,
            'tanggal_lahir' => $request->tanggal_lahir, 
            'hobby' => $request->hobby,
            'favorite_subject' => $request->favorite_subject,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'role' => 'siswa',
            'status' => 'pending', 
        ]);

        // 3. Notifikasi Inbox (Gunakan relasi untuk nama kelas jika perlu)
        $namaKelas = $user->kelas ? $user->kelas->nama_kelas : 'Tidak Diketahui';

        Inbox::create([
            'title' => 'Pendaftaran Siswa Baru',
            'message' => 'Siswa baru bernama ' . $user->name . ' (' . $namaKelas . ') baru saja mendaftar.',
            'link' => route('admin.verifikasi'), 
            'is_read' => false,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('registration.status');
    }
}