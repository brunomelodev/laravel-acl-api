<?php

use App\Http\Controllers\Api\Auth\AuthApiController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthApiController::class, 'auth'])->name('auth.login');
Route::post('/logout', [AuthApiController::class, 'logout'])->name('auth.logout')->middleware('auth:sanctum');
Route::post('/me', [AuthApiController::class, 'me'])->name('auth.me')->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/permissions', PermissionController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::get('/', fn() => response()->json(['message' => 'Welcome to the Laravel API.']));
