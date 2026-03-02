<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing Page (PUBLIC)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (HARUS LOGIN)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Role Pages
Route::get('/admin', function () {
    return "Ini Dashboard Admin";
})->middleware(['auth']);

Route::get('/guru', function () {
    return "Ini Dashboard Guru";
})->middleware(['auth']);

Route::get('/siswa', function () {
    return "Ini Dashboard Siswa";
})->middleware(['auth']);

// Public Pages
Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/program', function () {
    return view('program');
});

// Profile (Auth Only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';