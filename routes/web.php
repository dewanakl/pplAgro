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
Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {

    // dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // owner
    Route::middleware('role:owner')->group(function () {
        // Route::get('/owner', function () {
        //     return 'owner';
        // })->name('admin.page');

        Route::resource('agen', AgenController::class);
    });

    // agen
    Route::middleware('role:agen')->group(function () {
        // Route::get('/agen', function () {
        //     return 'agen';
        // })->name('user.page');
        Route::view('/tes', 'agen.index')->name('tes');
    });
});
