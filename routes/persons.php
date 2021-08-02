<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/users/show/{user}', [PersonController::class,'users_show'])->name('users_show');
Route::middleware('auth:sanctum', 'permission:Gestionar Usuarios')->get('/users', [PersonController::class,'index'])->name('users_index');
Route::middleware('auth:sanctum', 'permission:Gestionar Clientes')->get('/clients/show/{client}', [PersonController::class,'clients_show'])->name('clients_show');
Route::middleware('auth:sanctum', 'permission:Gestionar Clientes')->get('/clients/{query?}/', [PersonController::class,'clients_index'])->name('clients_index');
Route::middleware('auth:sanctum', 'permission:Gestionar Clientes')->get('/trash/clients/{query?}/{is_active?}', [PersonController::class,'clients_index'])->name('clients_trash');
Route::middleware('auth:sanctum', 'permission:Gestionar Clientes')->put('/clients/{client}', [PersonController::class,'clients_update'])->name('clients_update');
Route::middleware('auth:sanctum', 'permission:Gestionar Clientes')->put('/clients/delete/{client}', [PersonController::class,'clients_destroy'])->name('clients_destroy');
Route::middleware('auth:sanctum', 'permission:Gestionar Clientes')->get('/client/edit/{client}', [PersonController::class,'clients_edit'])->name('clients_edit');
Route::middleware(['auth:sanctum', 'role:Admin'])->get('/company', [PersonController::class,'company'])->name('user.company');