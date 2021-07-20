<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
Route::middleware('auth:sanctum', 'permission:Gestionar Sucursales')->get('/places', [InventoryController::class,'places_index'])->name('places_index');
Route::middleware('auth:sanctum', 'permission:Gestionar Productos')->get('/products', [InventoryController::class,'products_index'])->name('products_index');
Route::middleware('auth:sanctum', 'permission:Gestionar Sucursales')->get('/places/{place}', [InventoryController::class,'place_show'])->name('places_show');
