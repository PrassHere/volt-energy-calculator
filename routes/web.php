<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/login', [PageController::class, 'login']);
Route::get('/register', [PageController::class, 'register']);
Route::get('/eco-tips', [PageController::class, 'eco_tips']);
Route::get('/add-device', [PageController::class, 'add_device']);
Route::get('/dashboard', [PageController::class, 'dashboard']);
Route::get('/analytics', [PageController::class, 'analytics']);
Route::get('/history', [PageController::class, 'history']);



