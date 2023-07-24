<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\dbController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HitungController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AppController::class, 'index'])->name('apps.index');
Route::get('/baru', [AppController::class, 'create'])->name('apps.create');
Route::post('/baru', [AppController::class, 'store'])->name('apps.store');
Route::get('/hapus-app/{id}', [AppController::class, 'hapusApp'])->name('hapus-app');



Route::get('/dashboard/{appId}', [dbController::class, 'index'])->name('dashboard-getid');
Route::middleware(['check.appId'])->group(function () {
    Route::get('/dashboard', [dbController::class, 'show'])->name('dashboard');

    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

    Route::get('/data', [DataController::class, 'index'])->name('data.index');
    Route::post('/data', [DataController::class, 'store'])->name('data.store');
    Route::delete('/data/{id}', [DataController::class, 'destroy'])->name('data.destroy');

    Route::get('/hitung', [HitungController::class, 'index'])->name('hitung.index');

    Route::get('/end-session', [dbController::class, 'endSession'])->name('end-session');
});
