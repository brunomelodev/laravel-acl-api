<?php

use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/permissions', PermissionController::class);

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/', fn() => response()->json(['message' => 'Welcome to the Laravel API.']));