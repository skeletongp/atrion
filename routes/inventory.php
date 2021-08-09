<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cash;

Route::middleware([Cash::class,'auth:sanctum'])->group(function () {
    Route::middleware('permission:Gestionar Sucursales')->get('/places', [InventoryController::class, 'places_index'])->name('places_index');
    Route::middleware('permission:Gestionar Productos')->get('/printCodes', [InventoryController::class, 'printCodes'])->name('printCodes');
    Route::middleware('permission:Gestionar Productos')->get('/products/value', [InventoryController::class, 'products_value'])->name('products_value');
    Route::middleware('permission:Gestionar Productos')->get('/products/{search?}', [InventoryController::class, 'products_index'])->name('products_index');
    Route::middleware('role:Admin')->get('trash/products/{search?}/{status?}', [InventoryController::class, 'products_index'])->name('products_trash');
    Route::middleware('permission:Gestionar Productos')->post('/products/upload', [InventoryController::class, 'products_upload'])->name('products_upload');
    Route::middleware('permission:Gestionar Sucursales')->get('/places/{place}', [InventoryController::class, 'place_show'])->name('places_show');
});
