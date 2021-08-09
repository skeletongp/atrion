<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\FiscalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\Cash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware([Cash::class, 'auth:sanctum'])->group(function () {
    Route::middleware('permission:Gestionar Egresos')->get('/outcome', [AccountController::class,'outcome_index'])->name('outcome_index');
  
});