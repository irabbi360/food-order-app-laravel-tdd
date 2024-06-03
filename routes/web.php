<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchProductsController;
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

Route::get('/', [SearchProductsController::class, 'index']);

Route::get('cart', [CartController::class, 'index']);
Route::post('cart', [CartController::class, 'store']);
Route::delete('cart/{id}', [CartController::class, 'destroy']);
Route::patch('cart/{id}', [CartController::class, 'update']);

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/summary', function () {
    return view('summary');
});
