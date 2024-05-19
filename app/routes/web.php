<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/shop', function () {
    return view('role.shop.landing-page-shop');
})->name('landing-page-shop');


Route::get('/', function () {
    return view('landing-page');
})->name('landing-page');

Route::get('/tambah-produk', function () {
    return view('role.shop.tambah-produk');
})->name('tambah-produk');

Route::get('/Riwayat', function () {
    return view('role.shop.riwayat-page');
})->name('riwayat-page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware("checkRole:Admin,Kasir,ShopEmloyee")->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
