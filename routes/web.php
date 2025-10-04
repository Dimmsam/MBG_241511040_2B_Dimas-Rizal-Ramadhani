<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\DapurController;

// Route default
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Routes untuk Petugas Gudang
Route::middleware(['auth', 'role:gudang'])
    ->prefix('gudang')
    ->name('gudang.')
    ->group(function () {
        Route::get('/dashboard', [GudangController::class, 'dashboard'])    
            ->name('dashboard');
        Route::get('/bahan-baku/create', [GudangController::class, 'create'])
            ->name('bahan.create');
        Route::post('/bahan-baku', [GudangController::class, 'store'])
            ->name('bahan.store');
        Route::get('/bahan-baku', [GudangController::class, 'index'])
            ->name('bahan.index');
    });

// Routes untuk Petugas Dapur
Route::middleware(['auth', 'role:dapur'])
    ->prefix('dapur')
    ->name('dapur.')
    ->group(function () {
        Route::get('/dashboard', [DapurController::class, 'dashboard'])
            ->name('dashboard');
    });
    