<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/users', [PersonController::class,'index'])->name('users.index');
Route::middleware('auth:sanctum')->get('/users/{user}', [PersonController::class,'show'])->name('users.show');