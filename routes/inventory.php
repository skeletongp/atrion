<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
Route::middleware('auth:sanctum', 'permission:Gestionar Sucursales')->get('/places', [InventoryController::class,'places_index'])->name('places_index');
Route::middleware('auth:sanctum', 'permission:Gestionar Productos')->get('/products/{search?}', [InventoryController::class,'products_index'])->name('products_index');
Route::middleware('auth:sanctum', 'role:Admin')->get('trash/products/{search?}/{status?}', [InventoryController::class,'products_index'])->name('products_trash');
Route::middleware('auth:sanctum', 'permission:Gestionar Productos')->post('/products/upload', [InventoryController::class,'products_upload'])->name('products_upload');
Route::middleware('auth:sanctum', 'permission:Gestionar Sucursales')->get('/places/{place}', [InventoryController::class,'place_show'])->name('places_show');
