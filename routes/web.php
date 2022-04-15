<?php

use App\Http\Controllers\AgenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
Route::view('/', 'welcome')->name('welcome');

Route::middleware('auth')->group(function () {

    // dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // owner
    Route::middleware('role:owner')->group(function () {

        //Route::get('/agen/{id}/edit', [AgenController::class, 'edit'])->name('agen.edit');
        Route::resource('agen', AgenController::class);

        Route::get('/keuangan', fn () => view('owner.keuangan.index'))->name('keuangan');
        Route::get('/bahanbaku', fn () => view('owner.bahanbaku.index'))->name('bahanbaku');
        Route::get('/ownerpesanan', fn () => view('owner.pesanan.index'))->name('owner.pesanan');
    });

    // agen
    Route::middleware('role:agen')->group(function () {

        Route::view('/tes', 'agen.index')->name('tes');
        Route::get('/agenpesanan', fn () => view('agen.pesanan'))->name('agen.pesanan');
    });
});
