<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccommodationController;
Route::prefix('admin')->group(function () {

//    Accommodation
    Route::post('accommodation', [AccommodationController::class, 'create'])->name('accommodation.create');
    Route::put('accommodation/{id}', [AccommodationController::class, 'update'])->name('accommodation.update')->where('id', '[0-9]+');
    Route::delete('accommodation/{id}', [AccommodationController::class, 'delete'])->name('accommodation.delete')->where('id', '[0-9]+');
    Route::get('accommodation/{id}', [AccommodationController::class, 'find'])->name('accommodation.find')->where('id', '[0-9]+');
    Route::get('accommodation/search', [AccommodationController::class, 'search'])->name('accommodation.search');
    Route::get('accommodation/all', [AccommodationController::class, 'all'])->name('accommodation.all');
    Route::post('accommodation/changeStatus', [AccommodationController::class, 'changeStatus'])->name('accommodation.changeStatus');
    Route::post('accommodation/multipleDelete', [AccommodationController::class, 'multipleDelete'])->name('accommodation.multipleDelete');
});
