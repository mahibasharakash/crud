<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/registration', [AuthController::class, 'registration']);
    Route::post('/forgot', [AuthController::class, 'forgot']);
    Route::post('/reset', [AuthController::class, 'reset']);
    Route::post('/verification', [AuthController::class, 'verification']);
});

Route::middleware('auth:sanctum')->prefix('profile')->group(function () {
    Route::get('/user-details', [AuthController::class, 'details']);
    Route::post('/change-details', [AuthController::class, 'changeDetails']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
