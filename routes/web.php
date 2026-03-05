<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\JadwalController; // <-- ditambahkan
use App\Models\User;
use App\Models\Jadwal;

// Dashboard umum
Route::get('/', function () {
<<<<<<< HEAD
    return view('dashboard');
})->name('home');

// Middleware auth umum
=======

    if (Auth::check()) {

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::user()->role === 'pengajar') {
            return redirect()->route('pengajar.dashboard');
        }

        if (Auth::user()->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }
    }

    return view('dashboard'); // landing page untuk tamu
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
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
    Route::resource('jadwal', JadwalController::class); // <-- ini wajib untuk halaman admin jadwal

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

    Route::get('/', function () {
        return view('siswa.dashboard');
    })->name('dashboard');

    Route::get('/absen', function () {
        return view('siswa.absen');
    })->name('absen');

    // Jadwal siswa
    Route::get('/jadwal', function () {
        $jadwal = Jadwal::all(); // ambil semua jadwal
        return view('siswa.jadwal', compact('jadwal')); // kirim ke blade
    })->name('jadwal');
});

// ======================
// Pengajar Routes
// ======================
Route::middleware(['auth','role:pengajar'])
    ->prefix('pengajar')
    ->name('pengajar.')
    ->group(function () {
        Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('dashboard');
});

// Auth routes (login, register, logout)
require __DIR__.'/auth.php';