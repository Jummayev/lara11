<?php

use Illuminate\Support\Facades\Route;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

/** Start Language Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/languages')->middleware(['auth'])->group(function () {
        Route::get('/', [\Modules\Translation\app\Http\Controllers\LanguageController::class, 'index']);
        Route::post('/', [\Modules\Translation\app\Http\Controllers\LanguageController::class, 'store']);
        Route::get('{id}', [\Modules\Translation\app\Http\Controllers\LanguageController::class, 'show'])->whereNumber('id');
        Route::put('{language}', [\Modules\Translation\app\Http\Controllers\LanguageController::class, 'update'])->whereNumber('language');
        Route::delete('{language}', [\Modules\Translation\app\Http\Controllers\LanguageController::class, 'destroy'])->whereNumber('language');
    });
    Route::prefix('languages')->group(function () {
        Route::get('/', [\Modules\Translation\app\Http\Controllers\LanguageController::class, 'client']);
        Route::get('{id}', [\Modules\Translation\app\Http\Controllers\LanguageController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Language Routes */
