<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
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

Route::get('/', function () {
    return view('auth.home');
})->name('home');

    Route::get('/register', [AkunController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AkunController::class, 'register']);


    Route::get('/login', [AkunController::class, 'showLoginForm'])->name('login');
    Route::post('/logout', [AkunController::class, 'logout'])->name('logout');