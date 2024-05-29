<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
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

// Route::get('/shop', [ShopController::class, 'index']);

// Route::get('/', function () {
//     return view('landing-page');
// })->name('landing-page');

// Route::get('/tambah-produk', function () {
//     return view('role.shop.tambah-produk');
// })->name('tambah-produk');

// Route::get('/Riwayat', function () {
//     return view('role.shop.riwayat-page');
// })->name('riwayat-page');

// Route::get('/shop', function () {
//     return view('role.shop.order-page-shop');
// })->name('order-page');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware("checkRole:Admin,Kasir,ShopEmployee")->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|  Produk Route
*/
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');

    Route::get('/create', [ProductController::class, 'create'])->name('product.create');

    // Post create mungkin langsung tembak lewat form app kalau bisa
});

/*
| Kalau done nanti dashboard disini, bukan sendiri sendiri
| dashboard prefix
*/
Route::prefix('dashboard')->middleware("checkRole:Admin,Kasir")->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    // Order
    Route::get("/order", [OrderController::class, 'index']);
    Route::get("/order/create", [OrderController::class, 'create']);
    Route::get("/order/{slug}/edit", [OrderController::class, 'edit']);
    Route::post("/order", [OrderController::class, 'store']);
    Route::put("/order/{slug}", [OrderController::class, 'update']);
    Route::delete("/order/{slug}", [OrderController::class, 'destroy']);
    Route::get("/order/{slug}", [OrderController::class, 'show']);

    Route::get("/dev", [DashboardController::class, 'dev']);

    // Shop
    Route::get("/shop", [ShopController::class, 'index']);
    Route::get("/shop/create", [ShopController::class, 'create']);
    Route::post("/shop", [ShopController::class, 'store']);
    Route::delete("/shop/{slug}", [ShopController::class, 'destroy']);
    Route::get("/shop/{slug}", [ShopController::class, 'show']);

    // User
    Route::get("/user", [UserController::class, 'index']);
    Route::get("/user/create", [UserController::class, 'create']);
    Route::post("/user", [UserController::class, 'store']);
    Route::get("/user/{id}/edit", [UserController::class, 'edit']);


    /*
    |  Contoh Komponen yang bisa digunakan (tapi perlu di edit sesuai kebutuhan dulu ya guys)
    */
    Route::get(
        '/components',
        [DashboardController::class, 'components']
    );
});

// Jika user bukan admin, tapi kasir, dan shop employee maka setelah login kesini
Route::middleware("checkRole:ShopEmployee")->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/product/{slug}', [ClientController::class, 'show']);
    Route::get('/cart', [ClientController::class, 'showCart'])->name('clients.showCart');
    Route::post('/cart/add/{slug}', [ClientController::class, 'addToCart']);
    Route::post('/cart/remove/{slug}', [ClientController::class, 'removeFromCart'])->name('clients.removeFromCart');
    Route::post('/cart/clear', [ClientController::class, 'clearSession'])->name('clients.clearSession');
});




require __DIR__ . '/auth.php';
