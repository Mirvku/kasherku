<?php

use App\Http\Controllers\EditController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailPesanan;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\LaporanController;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Menu;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Coba;
use App\Http\Livewire\Pesanan;
use App\Http\Livewire\Transaksi;



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

Route::get('/', [HomeController::class, 'index'])->name('home');
Auth::routes();

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Route Menu
    Route::get('/menu-makanan', Menu::class)->name('menu');
    Route::get('/menu/edit/{id}', [EditController::class, 'index']);
    Route::post('/menu/update/{id}', [EditController::class, 'edit']);

    // Route Pesan Makanan
    Route::get('/pesan-makanan', Pesanan::class)->name('pesan');

    // Route Transaksi
    Route::get('/transaksi', Transaksi::class)->name('transaksi');
    Route::get('/detail-transaksi/{id}', [DetailPesanan::class, 'index']);

    // Route Tambah User
    Route::get('/create-user', [CreateUserController::class, 'index'])->name('create-user');
    Route::get('/create-user/create', [CreateUserController::class, 'create'])->name('tambah-user');
    Route::post('/create-user/insert', [CreateUserController::class, 'insert'])->name('insert-user');
    Route::get('/create-user/edit/{id}', [CreateUserController::class, 'edit'])->name('edit-user');
    Route::post('/create-user/update/{id}', [CreateUserController::class, 'update']);
    Route::post('/create-user/hapus/{id}', [CreateUserController::class, 'delete']);

    // Generate Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});

// Route::group([], function () {
//     Route::get('/', Login::class)->name('login');
//     Route::get('/register', Regiter::class)->name('register');
// });
