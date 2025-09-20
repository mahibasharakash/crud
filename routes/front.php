<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/all-blog', [HomeController::class, 'index'])->name('LIST.API.ALL.BLOG');
Route::get('/single-blog/{slug}', [HomeController::class, 'show'])->name('LIST.API.SHOW.BLOG');
