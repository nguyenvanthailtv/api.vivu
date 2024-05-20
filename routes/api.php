<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use 	Illuminate\Auth\Middleware\Authenticate;

use App\Http\Controllers\Auth\AuthController;
use App\Enums\TokenAbility;

require('admin_api.php');

Route::prefix('auth')->group(function () {
    Route::post('login' , [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::middleware(['ability:'.TokenAbility::ACCESS_TOKEN->value])->group(function () {
            Route::get('', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('auth.user');
            Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
        });

        Route::middleware(['ability:'.TokenAbility::REFRESH_TOKEN->value])->group(function () {
            Route::get('refresh', [AuthController::class, 'refreshToken'])->name('auth.refresh');
        });
    });
});





