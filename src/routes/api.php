<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products','App\Http\Controllers\ProductController');
Route::apiResource('clients','App\Http\Controllers\ClientController');
Route::apiResource('transactions','App\Http\Controllers\TransactionController');
Route::apiResource('product-types','App\Http\Controllers\ProductTypeController');
Route::apiResource('action-reports','App\Http\Controllers\ActionReportController');
