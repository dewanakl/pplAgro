<?php

use App\Http\Controllers\AgenController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\LandingController;
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

// breeze auth
require __DIR__ . '/auth.php';

// we're here
Route::get('/', LandingController::class)->name('welcome');

Route::middleware('auth')->group(function () {

    // halaman utama ? mau di isi apa : false;
    Route::get('/halamanutama', HalamanUtamaController::class)->name('halamanutama');

    // profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    // owner
    Route::middleware('role:owner')->group(function () {
        // agen dari owner
        Route::resource('agen', AgenController::class);
        Route::get('/agen/lokasi/{id}', [AgenController::class, 'lokasi'])->name('agen.lokasi');

        // pesanan
        Route::get('/ownerpesanan', [PesananController::class, 'semuaPesanan'])->name('owner.pesanan');

        /**
         * Ini belum yach
         */
        Route::view('/keuangan', 'owner.keuangan.index')->name('keuangan');
        Route::view('/bahanbaku', 'owner.bahanbaku.index')->name('bahanbaku');
    });

    // agen
    Route::middleware('role:agen')->group(function () {
        // pesanan
        Route::prefix('agenpesanan')->group(function () {
            Route::get('/', [PesananController::class, 'index'])->name('agen.pesanan');
            Route::get('/create', [PesananController::class, 'create'])->name('agen.pesanan.create');
            Route::post('/store', [PesananController::class, 'store'])->name('agen.pesanan.store');
            Route::get('/{id}/edit', [PesananController::class, 'edit'])->name('agen.pesanan.edit');
            Route::put('/{id}/update', [PesananController::class, 'update'])->name('agen.pesanan.update');
        });

        /**
         * Ini belum yach
         */
        Route::view('/pembayaran', 'agen.pembayaran')->name('agen.pembayaran');
    });
});
