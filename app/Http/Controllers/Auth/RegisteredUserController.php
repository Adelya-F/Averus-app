<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inbox; 
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
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi SEMUA field
        // Pastikan nama di sini SAMA dengan atribut 'name' di file register.blade.php
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'class' => ['required', 'string'],
            'school' => ['required', 'string', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'], // Sesuaikan dengan <input name="tanggal_lahir">
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
            'class' => $request->class,
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

        // 3. Buat Notifikasi Inbox untuk Admin
        // Pastikan model Inbox sudah benar dan ada kolom link, message, dll.
        Inbox::create([
            'title' => 'Pendaftaran Siswa Baru',
            'message' => 'Siswa baru bernama ' . $user->name . ' (Kelas ' . $user->class . ') baru saja mendaftar.',
            'link' => route('admin.verifikasi'), 
            'is_read' => false,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Pastikan route ini ada di web.php kamu
        return redirect()->route('registration.status');
    }
}