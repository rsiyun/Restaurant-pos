<?php

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
    return view('welcome');
});
// Route::put("/send", function(Request $request){
//     if ($request->hasFile("company_logo")) {
//         $gambar = $request->file("company_logo");
//         $response = Http::withHeaders([
//             'X-HTTP-Method-Override' => 'PUT',
//         ])->attach(
//             'company_logo',
//             file_get_contents($gambar),
//             $gambar->getClientOriginalName()
//         )->post('http://127.0.0.1:8001/api/test');

//         return $response->body();
//     }
// });
