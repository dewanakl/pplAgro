<?php

use App\Http\Controllers\AgenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\KeuanganController;
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

    Route::get('/halamanutama', HalamanUtamaController::class)->name('halamanutama');

    Route::get('/status/{id}/pesanan', [PesananController::class, 'apiPesanan']);

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'index')->name('profile');
        Route::get('/edit', 'edit')->name('profile.edit');
        Route::put('/update', 'update')->name('profile.update');
    });

    Route::middleware('role:owner')->group(function () {

        Route::controller(AgenController::class)->prefix('agen')->name('agen.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/show', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}/update', 'update')->name('update');
            Route::get('/{id}/lokasi', 'lokasi')->name('lokasi');
        });

        Route::controller(PesananController::class)->prefix('ownerpesanan')->name('owner.')->group(function () {
            Route::get('/', 'owner')->name('pesanan');
            Route::get('/{id}/edit', 'ownerEdit')->name('pesanan.edit');
            Route::put('/{id}/update', 'ownerUpdate')->name('pesanan.update');
            Route::get('/{id}/detail', 'ownerDetail')->name('pesanan.detail');
        });

        Route::controller(KeuanganController::class)->prefix('keuangan')->group(function () {
            Route::get('/', 'index')->name('keuangan');
            Route::get('/produk', 'produk')->name('keuangan.produk');
            Route::get('/create', 'create')->name('keuangan.create');
            Route::post('/store', 'store')->name('keuangan.store');
            Route::get('/{id}/edit', 'edit')->name('keuangan.edit');
            Route::put('/{id}/update', 'update')->name('keuangan.update');
            Route::put('/{id}/produk', 'produkUpdate')->name('keuangan.produk.update');
        });

        Route::controller(BahanBakuController::class)->prefix('bahanbaku')->group(function () {
            Route::get('/', 'index')->name('bahanbaku');
            Route::get('/create', 'create')->name('bahanbaku.create');
            Route::post('/store', 'store')->name('bahanbaku.store');
            Route::get('/{id}/edit', 'edit')->name('bahanbaku.edit');
            Route::put('/{id}/update', 'update')->name('bahanbaku.update');
        });
    });

    Route::middleware('role:agen')->name('agen.')->group(function () {

        Route::controller(PesananController::class)->prefix('agenpesanan')->group(function () {
            Route::get('/', 'agen')->name('pesanan');
            Route::get('/create', 'create')->name('pesanan.create');
            Route::post('/store', 'store')->name('pesanan.store');
            Route::get('/{id}/edit', 'edit')->name('pesanan.edit');
            Route::put('/{id}/update', 'update')->name('pesanan.update');
            Route::put('/{id}/selesai', 'selesai')->name('pesanan.selesai');
        });

        Route::controller(PembayaranController::class)->prefix('pembayaran')->group(function () {
            Route::get('/', 'index')->name('pembayaran');
            Route::get('/create', 'create')->name('pembayaran.create');
            Route::post('/store', 'store')->name('pembayaran.store');
            Route::get('/{id}/edit', 'edit')->name('pembayaran.edit');
            Route::put('/{id}/update', 'update')->name('pembayaran.update');
        });
    });
});
