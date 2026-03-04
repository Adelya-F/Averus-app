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
        // 1. Validasi SEMUA field yang ada di form register kamu
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'class' => ['required', 'string'],
            'school' => ['required', 'string', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'hobby' => ['nullable', 'string'],
            'favorite_subject' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'tiktok' => ['nullable', 'string'],
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
            'hobby' => $request->hobby,
            'favorite_subject' => $request->favorite_subject,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'role' => 'siswa',
            'status' => 'pending', 
        ]);

        // 3. Buat Notifikasi Inbox untuk Admin
        Inbox::create([
            'title' => 'Pendaftaran Siswa Baru',
            'message' => 'Siswa baru bernama ' . $user->name . ' (Kelas ' . $user->class . ') baru saja mendaftar.',
            'link' => route('admin.verifikasi'), 
            'is_read' => false,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Pastikan route 'registration.status' sudah ada di web.php
        return redirect()->route('registration.status');
    }
}