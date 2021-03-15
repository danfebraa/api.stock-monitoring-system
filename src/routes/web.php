<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('products', \App\Http\Controllers\Web\ProductController::class);
Route::resource('clients', \App\Http\Controllers\Web\ClientController::class);
Route::resource('product-types', \App\Http\Controllers\Web\ProductTypeController::class);

require __DIR__.'/auth.php';
