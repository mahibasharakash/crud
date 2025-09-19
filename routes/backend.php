<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login'])->name('LOGIN.API.AUTH');
    Route::post('/registration', [AuthController::class, 'registration'])->name('REGISTRATION.API.AUTH');
    Route::post('/forgot', [AuthController::class, 'forgot'])->name('FORGOT.API.AUTH');
    Route::post('/reset', [AuthController::class, 'reset'])->name('RESET.API.AUTH');
    Route::post('/verification', [AuthController::class, 'verification'])->name('VERIFICATION.API.AUTH');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('profile')->group(function() {
        Route::get('/user-details', [AuthController::class, 'details'])->name('USER.DETAILS.API.PROFILE');
        Route::post('/change-details', [AuthController::class, 'changeDetails'])->name('USER.CHANGE.DETAILS.API.PROFILE');
        Route::post('/change-password', [AuthController::class, 'changePassword'])->name('USER.CHANGE.PASSWORD.API.PROFILE');
        Route::post('/logout', [AuthController::class, 'logout'])->name('USER.LOGOUT.API.PROFILE');
        Route::post('/delete-account', [AuthController::class, 'deleteAccount'])->name('USER.DELETE.ACCOUNT.API.PROFILE');
    });

    Route::prefix('crud')->group(function() {
        Route::get('/list', [CrudController::class, 'index'])->name('LIST.API.CRUD');
        Route::post('/store', [CrudController::class, 'store'])->name('STORE.API.CRUD');
        Route::get('/show/{id}', [CrudController::class, 'show'])->name('SHOW.API.CRUD');
        Route::put('/update/{id}', [CrudController::class, 'update'])->name('UPDATE.API.CRUD');
        Route::delete('/delete/{id}', [CrudController::class, 'destroy'])->name('DELETE.API.CRUD');
    });

});
