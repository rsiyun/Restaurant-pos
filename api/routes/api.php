<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\TicketDetailsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/token', [AuthController::class, "showWithToken"]);
    Route::group(['middleware' => ['checkrole:Admin,ShopEmployee']], function () {
        Route::get("product", [ProductController::class, 'index']);
        Route::get("product/{product}", [ProductController::class, 'show']);
        Route::get("productByShop/{product}", [ProductController::class, 'showByShop']);
        Route::post("product", [ProductController::class, 'store']);
        Route::put("product/{product}", [ProductController::class, 'update']);
        Route::put("ticket/{ticket}", [TicketsController::class, 'update']);
        Route::get("ticketByShop/{shop}", [TicketsController::class, 'ticketByShop']);
        Route::get("shop/{shop}", [ShopController::class, 'show']);
        Route::post("ticket", [TicketsController::class, 'store']);

    });
    Route::group(['middleware' => ['checkrole:Admin,Kasir']], function () {
        Route::get("/dashboard", [UserController::class, "dashboard"]);
        Route::get("order", [OrdersController::class, 'index']);
        Route::get("/unpaymentTicket", [TicketsController::class, 'unpayment']);
        Route::get("order/{order}", [OrdersController::class, 'show']);
        Route::post("order", [OrdersController::class, 'store']);
        Route::delete("order/{order}", [OrdersController::class, 'destroy']);
        Route::put("order/{order}", [OrdersController::class, 'update']);
    });
    Route::group(['middleware' => ['checkrole:Admin']], function () {
        Route::get("/user", [UserController::class, "index"]);
        Route::get("/user/{user}", [UserController::class, 'show']);
        Route::post("/user", [UserController::class, 'store']);
        Route::put("/user/{user}", [UserController::class, 'update']);
        Route::delete("/user/{user}", [UserController::class, 'destroy']);
        Route::get("shop", [ShopController::class, 'index']);
        Route::get("shop/{shop}", [ShopController::class, 'show']);
        Route::post("shop", [ShopController::class, 'store']);
        Route::put("shop/{shop}", [ShopController::class, 'update']);
        Route::delete("shop/{shop}", [ShopController::class, 'destroy']);

    });
});


// Route::post('/register', [AuthController::class, 'register']);

// Route::get("ticket", [TicketsController::class, 'index']);

Route::get("ticketDetail", [TicketDetailsController::class, 'index']);
Route::get("ticketDetail/{slug}", [TicketDetailsController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum', 'checkrole:Kasir']], function () {

});

