<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;


// Routes ambazo hazipo ndani ya middleware
Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);  // Refresh token
});

// Protected rutes
Route::group([
    'middleware' => 'api'
], function () {

    // Logout
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);  

    
    Route::group(['prefix' => 'ratings'], function () {
        // kwa ajili ya rating au kufanya update kama the same user atafanya rate mara ya pili
        Route::post('products/{productId}/rate', [RatingController::class, 'rateProduct']);

        // Remove a rating
        Route::delete('products/{productId}/rate', [RatingController::class, 'removeRating']);

        // List products with their average ratings and user-specific ratings
        Route::get('products', [RatingController::class, 'listProducts']);
    });

    
});
