<?php

/** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */
/** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */
/** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */
/** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */
/** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */ /** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */ /** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */ /** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */ /** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */
/** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */
/** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */ /** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */
/** Start Post Routes */
Route::prefix('v1')->group(function () {
    Route::prefix('admin/posts')->middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'show'])->whereNumber('id');
        Route::put('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'update'])->whereNumber('post');
        Route::delete('{post}', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy'])->whereNumber('post');
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\V1\PostController::class, 'client']);
        Route::get('{id}', [\App\Http\Controllers\Api\V1\PostController::class, 'clientShow'])->whereNumber('id');
    });
});
/** End Post Routes */
