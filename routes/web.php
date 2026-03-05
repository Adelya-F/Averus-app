<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SiswaController;
use App\Models\Jadwal;


// Landing / Redirect
Route::get('/', function () {
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
    return view('dashboard');
})->name('home');


// Profile & Global Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registration-status', function () {
        return view('siswa.status');
    })->name('registration.status');
});


// Admin Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
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


// Siswa Routes 
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/', [SiswaController::class, 'index'])->name('dashboard');

        Route::middleware('check.status')->group(function () {
            Route::get('/absen', function () {
                return view('siswa.absen');
            })->name('absen');

            Route::get('/jadwal', function () {
                $jadwal = Jadwal::all();
                return view('siswa.jadwal', compact('jadwal'));
            })->name('jadwal');
        });
    });

// Pengajar Routes
Route::middleware(['auth', 'role:pengajar'])
    ->prefix('pengajar')
    ->name('pengajar.')
    ->group(function () {
        Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('dashboard');
    });

// Auth
require __DIR__.'/auth.php';