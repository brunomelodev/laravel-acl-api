<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/', fn() => response()->json(['message' => 'Welcome to the Laravel API.']));