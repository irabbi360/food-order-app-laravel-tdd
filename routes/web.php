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
    $items = \App\Models\Product::all();
    return view('search', compact('items'));
});

Route::get('/cart', function () {
    return view('cart');
});


Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/summary', function () {
    return view('summary');
});
