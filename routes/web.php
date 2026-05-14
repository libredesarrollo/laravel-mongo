<?php

use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\CalendarController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes(); // Requires laravel/ui package
/*middleware('auth')->*/
Route::prefix('dashboard')->group(function () {
    Route::resource('book', BookController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('tag', TagController::class);

    Route::get('tag/add/{book}/{tag}', [BookController::class, 'tag_add']);
    Route::get('tag/destroy/{book}/{tag}', [BookController::class, 'tag_destroy']);

    Route::prefix('test')->controller(TestController::class)->group(function () {
        Route::get('elem_match', 'test');
        Route::get('in', 'in');
        Route::get('exist', 'in');
        Route::get('size', 'size');
        Route::get('array_position', 'array_position');
        Route::get('mayor_a', 'mayor_a');
        Route::get('menor_a', 'menor_a');
        Route::get('slice', 'slice');
        Route::get('pagination', 'pagination');
        Route::get('where_raw', 'where_raw');
        Route::get('raw', 'raw');
    });

    Route::get('/', [CalendarController::class, 'index']);
    Route::post('/event/file/{event}', [CalendarController::class, 'file'])->name("event.file");
});
