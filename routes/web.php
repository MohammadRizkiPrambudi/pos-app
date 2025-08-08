<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/', function () {
    return view('home');
});

Route::resource('barang', BarangController::class);
Route::get('/kasir', [TransaksiController::class, 'kasir'])->name('kasir');
Route::post('/kasir', [TransaksiController::class, 'store'])->name('kasir.store');
Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');
Route::get('/riwayat-transaksi/{id}', [TransaksiController::class, 'detail'])->name('transaksi.detail');