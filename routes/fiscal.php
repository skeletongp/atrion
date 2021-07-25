<?php

use App\Http\Controllers\FiscalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\Cash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware([Cash::class, 'auth:sanctum'])->group(function () {
    Route::middleware('permission:Gestionar Ingresos')->get('/', [FiscalController::class,'fiscal_index'])->name('fiscal_index');
  
});