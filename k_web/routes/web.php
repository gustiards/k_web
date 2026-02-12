<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KsLabelController;
use App\Http\Controllers\CoverStController;
use App\Http\Controllers\BaDdrController;
use App\Http\Controllers\BaStController;
use App\Http\Controllers\ListDamageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::resource('kslabel', KsLabelController::class);
Route::get('/cover-st', [CoverStController::class, 'index'])->name('coverst.index');

Route::get('/ba-ddr', [BaDdrController::class, 'index'])->name('ba.ddr');
Route::get('/ba-st', [BaStController::class, 'index'])->name('ba.st');
Route::get('/list-damage', [ListDamageController::class, 'index'])->name('list.damage');


// Protected dulu
Route::middleware(['auth'])->group(function () {
    Route::resource('articles', ArticleController::class)
        ->except(['index', 'show']);
});

// Baru show di bawah
Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
