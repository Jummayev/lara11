<?php

use Illuminate\Support\Facades\Route;

Route::domain('localhost')->get('/', function () {
    return view('welcome');
});

/** Start Language Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/languages')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{language}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('language');
        Route::delete('{language}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('language');
    });
    Route::prefix('languages')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Language Routes */
