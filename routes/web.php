<?php

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
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {
            return 'admin';
        })->name('admin.page');
    });

    // user
    Route::middleware('role:user')->group(function () {
        Route::get('/user', function () {
            return 'user';
        })->name('user.page');
    });
});
