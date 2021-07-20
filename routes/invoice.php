<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'permission:Vender')->get('/sale/{cotize?}', [InvoiceController::class,'sale'])->name('sale');