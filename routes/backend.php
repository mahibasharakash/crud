<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\CategoryController;

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
        Route::post('/upload-image', [AuthController::class, 'uploadImage'])->name('USER.UPLOAD.IMAGE.API.PROFILE');
        Route::post('/remove-image', [AuthController::class, 'removeImage'])->name('USER.REMOVE.IMAGE.API.PROFILE');
    });

    Route::prefix('crud')->group(function() {
        Route::get('/list', [CrudController::class, 'index'])->name('LIST.API.CRUD');
        Route::post('/store', [CrudController::class, 'store'])->name('STORE.API.CRUD');
        Route::get('/show/{id}', [CrudController::class, 'show'])->name('SHOW.API.CRUD');
        Route::put('/update/{id}', [CrudController::class, 'update'])->name('UPDATE.API.CRUD');
        Route::delete('/delete/{id}', [CrudController::class, 'destroy'])->name('DELETE.API.CRUD');
    });

    Route::prefix('category')->group(function() {
        Route::get('/list', [CategoryController::class, 'index'])->name('LIST.API.CATEGORY');
        Route::post('/store', [CategoryController::class, 'store'])->name('STORE.API.CATEGORY');
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('SHOW.API.CATEGORY');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('UPDATE.API.CATEGORY');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('DELETE.API.CATEGORY');
        Route::get('/get-category', [CategoryController::class, 'getCategory'])->name('GET.CATEGORY.API.CATEGORY');
    });

});
