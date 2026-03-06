<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SiswaController;
use App\Models\Jadwal;

// Dashboard / Landing Page dengan Logika Redirect Role
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'pengajar') {
            return redirect()->route('pengajar.dashboard');
        } elseif ($role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }
    }
    return view('dashboard'); // Tampilan untuk tamu (guest)
})->name('home');

// Middleware Auth Umum
// Middleware Auth Umum
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // PERBAIKAN DI SINI: Ganti @patch menjadi Route::patch
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registration-status', function () {
        return view('siswa.status');
    })->name('registration.status');
});

// ======================
// Admin Routes
// ======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Pengajar
    Route::get('/pengajar', [AdminController::class, 'pengajar'])->name('pengajar');
    Route::get('/pengajar/create', [AdminController::class, 'createPengajar'])->name('pengajar.create');
    Route::post('/pengajar/store', [AdminController::class, 'storePengajar'])->name('pengajar.store');

    // Jadwal admin CRUD
    Route::resource('jadwal', JadwalController::class);

    // Verifikasi siswa
    Route::get('/verifikasi', [AdminController::class, 'verifikasiSiswa'])->name('verifikasi');
    Route::patch('/verifikasi/{user}/update', [AdminController::class, 'updateStatus'])->name('verifikasi.update');

    // Inbox
    Route::get('/inbox', [AdminController::class, 'inbox'])->name('inbox');
    Route::get('/inbox/read/{id}', [AdminController::class, 'readInbox'])->name('inbox.read');
});

// ======================
// Siswa Routes
// ======================
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    
    // Dashboard dasar (bisa diakses sebelum verifikasi jika perlu)
    Route::get('/dashboard', function () {
        return view('siswa.dashboard');
    })->name('dashboard');

    // Route khusus yang butuh status terverifikasi (check.status)
    Route::middleware(['check.status'])->group(function () {
        Route::get('/absen', function () {
            return view('siswa.absen');
        })->name('absen');

        Route::get('/jadwal', function () {
            $jadwal = Jadwal::all();
            return view('siswa.jadwal', compact('jadwal'));
        })->name('jadwal');
    });
});

// ======================
// Pengajar Routes
// ======================
Route::middleware(['auth', 'role:pengajar'])->prefix('pengajar')->name('pengajar.')->group(function () {
    Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('dashboard');
});

// Auth routes (login, register, logout)
require __DIR__.'/auth.php';