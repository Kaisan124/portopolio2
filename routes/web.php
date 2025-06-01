<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\PenilaianTugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengumpulanTugasController;

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
Route::get('/', [AkunController::class, 'home'])->name('home');

    Route::get('/register', [AkunController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AkunController::class, 'register']);


    Route::get('/login', [AkunController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AkunController::class, 'login'])->name('login');

    Route::get('/logout', [AkunController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
        // Route::get('/pengumpulantugas', [DashboardController::class, 'pengumpulantugas']);
    

Route::resource('/pengumpulan', PengumpulanTugasController::class);
Route::get('/pengumpulantugas', [PengumpulanTugasController::class, 'index'])->name('pengumpulan.index');
Route::get('/pengumpulanupload/{id}', [PengumpulanTugasController::class, 'uploadForm'])->name('pengumpulan.uploadForm');
Route::post('/pengumpulanupload/{id}', [PengumpulanTugasController::class, 'uploadFile'])->name('pengumpulan.uploadFile');
Route::get('/pengumpulan/{id}/detail', [PengumpulanTugasController::class, 'show'])->name('pengumpulan.show');
Route::get('/editpengumpulan/{id}', [PengumpulanTugasController::class, 'edit'])->name('pengumpulan.edit');
Route::put('/editpengumpulan/{id}', [PengumpulanTugasController::class, 'update'])->name('pengumpulan.update');
Route::get('/penilaiantugas', [PenilaianTugasController::class, 'index'])->name('penilaian.index');
Route::resource('penilaian', PenilaianTugasController::class);
Route::get('/penilaian', [PenilaianTugasController::class, 'index']);


