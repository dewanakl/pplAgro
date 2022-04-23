<?php

use App\Http\Controllers\AgenController;
use App\Http\Controllers\LandingController;
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

    // dashboard
    Route::view('/dashboard', 'halamanUtama')->name('dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // owner
    Route::middleware('role:owner')->group(function () {

        Route::resource('agen', AgenController::class);

        Route::view('/keuangan', 'owner.keuangan.index')->name('keuangan');
        Route::view('/bahanbaku', 'owner.bahanbaku.index')->name('bahanbaku');
        Route::view('/ownerpesanan', 'owner.pesanan.index')->name('owner.pesanan');
    });

    // agen
    Route::middleware('role:agen')->group(function () {

        Route::view('/agenpesanan', 'agen.pesanan')->name('agen.pesanan');
        Route::view('/pembayaran', 'agen.pembayaran')->name('agen.pembayaran');
    });
});
