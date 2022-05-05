<?php

use App\Http\Controllers\AgenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ok let's go

Route::get('/', LandingController::class)->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {

    // halaman utama ? mau di isi apa : false;
    Route::get('/halamanutama', HalamanUtamaController::class)->name('halamanutama');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::middleware('role:owner')->group(function () {
        Route::resource('agen', AgenController::class)->except(['lokasi']);
        Route::get('/agen/{id}/lokasi', [AgenController::class, 'lokasi'])->name('agen.lokasi');

        Route::prefix('ownerpesanan')->group(function () {
            Route::get('/', [PesananController::class, 'owner'])->name('owner.pesanan');
            Route::get('/{id}/edit', [PesananController::class, 'ownerEdit'])->name('owner.pesanan.edit');
            Route::put('/{id}/update', [PesananController::class, 'ownerUpdate'])->name('owner.pesanan.update');
            Route::get('/{id}/detail', [PesananController::class, 'ownerDetail'])->name('owner.pesanan.detail');
        });

        /**
         * Ini belum yach
         */
        Route::view('/keuangan', 'owner.keuangan.index')->name('keuangan');
        Route::view('/bahanbaku', 'owner.bahanbaku.index')->name('bahanbaku');
    });

    Route::middleware('role:agen')->group(function () {
        Route::prefix('agenpesanan')->group(function () {
            Route::get('/', [PesananController::class, 'agen'])->name('agen.pesanan');
            Route::get('/create', [PesananController::class, 'create'])->name('agen.pesanan.create');
            Route::post('/store', [PesananController::class, 'store'])->name('agen.pesanan.store');
            Route::get('/{id}/edit', [PesananController::class, 'edit'])->name('agen.pesanan.edit');
            Route::put('/{id}/update', [PesananController::class, 'update'])->name('agen.pesanan.update');
        });
        Route::prefix('pembayaran')->group(function () {
            Route::get('/', [PembayaranController::class, 'index'])->name('agen.pembayaran');
            Route::get('/create', [PembayaranController::class, 'create'])->name('agen.pembayaran.create');
            Route::post('/store', [PembayaranController::class, 'store'])->name('agen.pembayaran.store');
            Route::get('/{id}/edit', [PembayaranController::class, 'edit'])->name('agen.pembayaran.edit');
            Route::put('/{id}/update', [PembayaranController::class, 'update'])->name('agen.pembayaran.update');
        });
    });
});
