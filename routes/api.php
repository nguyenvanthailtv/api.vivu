<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use 	Illuminate\Auth\Middleware\Authenticate;

require('admin_api.php');
Route::prefix('auth')->group(function () {
    Route::post('login' , [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('auth.login');

});



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('auth.user');
    Route::get('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('auth.logout');
});

