<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\Cash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware([Cash::class, 'auth:sanctum'])->group(function () {
    Route::middleware('permission:Vender')->get('/sale/{cotize?}', [InvoiceController::class,'sale'])->name('sale');
    Route::middleware('permission:Vender')->get('/preview/{invoice}', [InvoiceController::class,'preview'])->name('preview');
    Route::middleware('permission:Vender')->get('/preview_cotize/{cotize}', [InvoiceController::class,'preview_cotize'])->name('preview_cotize');
    Route::middleware('permission:Gestionar Facturas')->get('/invoices', [InvoiceController::class,'invoices'])->name('invoices');
    Route::middleware('permission:Gestionar Facturas')->get('/cotizes', [InvoiceController::class,'cotizes'])->name('cotizes');
    Route::middleware('permission:Gestionar Ingresos')->get('/invoices/{client}', [InvoiceController::class,'invoices_filter'])->name('invoices_filter');
});