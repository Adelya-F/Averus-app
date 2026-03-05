<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use App\Models\Jadwal;

// Landing page / redirect berdasarkan role
Route::get('/', function () {
    if (Auth::check()) {
        switch (Auth::user()->role) {
            case 'admin': return redirect()->route('admin.dashboard');
            case 'pengajar': return redirect()->route('pengajar.dashboard');
            case 'siswa': return redirect()->route('siswa.dashboard');
        }
    }
    return view('dashboard');
})->name('home');

// =====================================
// PROFILE ROUTES (auth umum)
// =====================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registration-status', function () {
        return view('siswa.status');
    })->name('registration.status');
});

// =====================================
// ADMIN ROUTES
// =====================================
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengajar', [AdminController::class, 'pengajar'])->name('pengajar');
    Route::get('/pengajar/create', [AdminController::class, 'createPengajar'])->name('pengajar.create');
    Route::post('/pengajar/store', [AdminController::class, 'storePengajar'])->name('pengajar.store');

    Route::resource('jadwal', JadwalController::class);

    Route::get('/verifikasi', [AdminController::class, 'verifikasiSiswa'])->name('verifikasi');
    Route::patch('/verifikasi/{user}/update', [AdminController::class, 'updateStatus'])->name('verifikasi.update');

    Route::get('/inbox', [AdminController::class, 'inbox'])->name('inbox');
    Route::get('/inbox/read/{id}', [AdminController::class, 'readInbox'])->name('inbox.read');
});

// =====================================
// SISWA ROUTES
// =====================================
Route::middleware(['auth','role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('dashboard');

    Route::middleware(['check.status'])->group(function () {
        Route::get('/absen', function () { return view('siswa.absen'); })->name('absen');
        Route::get('/jadwal', function () {
            $jadwal = Jadwal::all();
            return view('siswa.jadwal', compact('jadwal'));
        })->name('jadwal');
    });
});

// =====================================
// PENGAJAR ROUTES
// =====================================
Route::middleware(['auth','role:pengajar'])->prefix('pengajar')->name('pengajar.')->group(function () {
    Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('dashboard');
});

// =====================================
// AUTH ROUTES
// =====================================
require __DIR__.'/auth.php';