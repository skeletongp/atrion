<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/', [UsersController::class,'index'])->name('user.index');
Route::middleware(['auth:sanctum', 'role:Admin'])->get('/company', [UsersController::class,'company'])->name('user.company');
Route::middleware('auth:sanctum')->get('/users/{user}', [UsersController::class,'show'])->name('user.show');