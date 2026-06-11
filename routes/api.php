<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FoodItemController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\AddressController;

use App\Http\Controllers\API\Rider\RiderAuthController;
use App\Http\Controllers\API\Rider\RiderOrderController;
use App\Http\Controllers\API\Rider\RiderProfileController;
use App\Http\Controllers\API\Rider\RiderLocationController;

Route::get('/test', function () {
    return response()->json([
        'status' => 'api ok'
    ]);
});

// CUSTOMER API
Route::prefix('customer')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // PUBLIC CATALOG ROUTES
    Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
    Route::apiResource('food-items', FoodItemController::class)->only(['index', 'show']);

    // PROTECTED CUSTOMER ROUTES
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/profile', [AuthController::class, 'profile']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('addresses', AddressController::class);
        Route::apiResource('cart', CartController::class);
        Route::apiResource('orders', OrderController::class);

        Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus']);
    });
});

// RIDER API
Route::prefix('rider')->group(function () {

    Route::post('/login', [RiderAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/profile', [RiderProfileController::class, 'show']);
        Route::put('/profile', [RiderProfileController::class, 'update']);

        Route::get('/orders', [RiderOrderController::class, 'index']);
        Route::get('/orders/{id}', [RiderOrderController::class, 'show']);
        Route::patch('/orders/{id}/status', [RiderOrderController::class, 'updateStatus']);
        Route::patch('/orders/{id}/accept', [RiderOrderController::class, 'accept']);

        Route::post('/location', [RiderLocationController::class, 'update']);
    });
});