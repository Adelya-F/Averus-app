<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

// 1. Grup Profile & Status
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registration-status', function () {
        return view('siswa.status');
    })->name('registration.status');
});

// 2. Home
Route::get('/', function () {
    return view('dashboard');
})->name('home');

// 3. Grup Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/pengajar', [AdminController::class, 'pengajar'])->name('admin.pengajar');
    Route::get('/admin/pengajar/create', [AdminController::class, 'createPengajar'])->name('admin.pengajar.create');
    Route::post('/admin/pengajar/store', [AdminController::class, 'storePengajar'])->name('admin.pengajar.store');
});

// 4. Grup Siswa
Route::middleware(['auth', 'role:siswa'])->group(function () {

    Route::get('/siswa', function () {
        // Jika status bukan accepted, lempar balik ke halaman status
        if (auth()->user()->status !== 'accepted') {
            return redirect()->route('registration.status');
        }
        return view('siswa.dashboard');
    })->name('siswa.dashboard');

    Route::get('/siswa/absen', function () {
        // Tambahkan proteksi yang sama agar tidak bisa tembus lewat URL
        if (auth()->user()->status !== 'accepted') {
            return redirect()->route('registration.status');
        }
        return view('siswa.absen');
    })->name('siswa.absen');

    Route::get('/siswa/jadwal', function () {
        if (auth()->user()->status !== 'accepted') {
            return redirect()->route('registration.status');
        }
        return view('siswa.jadwal');
    })->name('siswa.jadwal');
});

require __DIR__.'/auth.php';