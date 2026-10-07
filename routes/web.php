<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::middleware('guest')->group(function () {
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.process');

    Route::get('/registrasi', [PageController::class, 'registrasi'])->name('registrasi');
    Route::post('/registrasi', [UserController::class, 'register'])->name('registrasi.process');
});

Route::middleware('auth')->group(function () {
    // Halaman utama
    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');

    // Halaman fitur
    Route::get('/analytics', [PageController::class, 'analytics'])->name('analytics');
    Route::get('/history', [PageController::class, 'history'])->name('history');
    Route::get('/eco-tips', [PageController::class, 'ecoTips'])->name('eco-tips');
    Route::get('/add-device', [PageController::class, 'addDevice'])->name('add-device');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});