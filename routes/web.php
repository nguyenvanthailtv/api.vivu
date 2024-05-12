<?php

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('activity')->group(function () {
    Route::post('/', [ActivityController::class, 'create'])->name('activity.create');
    Route::put('/{id}', [ActivityController::class, 'update'])->name('activity.update')->where('id', '[0-9]+');
    Route::delete('/{id}', [ActivityController::class, 'delete'])->name('activity.delete')->where('id', '[0-9]+');
    Route::get('/{id}', [ActivityController::class, 'find'])->name('activity.find')->where('id', '[0-9]+');
    Route::get('/search', [ActivityController::class, 'search'])->name('activity.search');
    Route::get('/all', [ActivityController::class, 'all'])->name('activity.all');
    Route::post('/changeStatus', [ActivityController::class, 'changeStatus'])->name('activity.changeStatus');
    Route::post('/multipleDelete', [ActivityController::class, 'multipleDelete'])->name('activity.multipleDelete');
});
