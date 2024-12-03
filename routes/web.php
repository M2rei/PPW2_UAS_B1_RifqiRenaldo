<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailController;
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

// Route ke halaman awal (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Route untuk login dan autentikasi
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

// Group routes dengan middleware auth
Route::middleware(['auth'])->group(function () {
    // Route dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route transaksi
    Route::prefix('/transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('store', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
        Route::put('update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
        Route::delete('delete/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    });

    // Route transaksi detail
    Route::prefix('/transaksidetail')->group(function () {
        Route::get('/', [TransaksiDetailController::class, 'index'])->name('transaksidetail.index');
        Route::get('/{id_transaksi}', [TransaksiDetailController::class, 'detail'])->name('transaksidetail.detail');
        Route::get('edit/{id}', [TransaksiDetailController::class, 'edit'])->name('transaksidetail.edit');
        Route::put('update/{id}', [TransaksiDetailController::class, 'update'])->name('transaksidetail.update');
        Route::delete('delete/{id}', [TransaksiDetailController::class, 'destroy'])->name('transaksidetail.destroy');
    });
});
