<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login' , [\App\Http\Controllers\Api\AuthController::class , 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/check-availability', [\App\Http\Controllers\Api\TableController::class, 'checkAvailability']);
    Route::post('/reserve-table', [\App\Http\Controllers\Api\ReservationController::class, 'reserveTable']);
    Route::get('/list-menu-items', [\App\Http\Controllers\Api\MealController::class, 'listMenuItems']);
    Route::post('/place-order', [\App\Http\Controllers\Api\OrderController::class, 'placeOrder']);
    Route::post('/checkout', [\App\Http\Controllers\Api\CheckoutController::class, 'checkout']);
});
