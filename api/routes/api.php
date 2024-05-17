<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TicketsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::resource('user', UserController::class);
Route::get("orders", [OrdersController::class, 'index']);
Route::get("orders/{orders}", [OrdersController::class, 'show']);
Route::resource("shop", ShopController::class);
// Route::get("orders/{orders}", [OrdersController::class, 'show']);
Route::resource("ticket", TicketsController::class);
Route::get("/unpaymentTicket", [TicketsController::class, 'unpayment']);
Route::group(['middleware' => ['auth:sanctum','checkrole:Kasir']], function() {
    Route::resource("product", ProductController::class);
});

