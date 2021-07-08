<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/migrate',function ()
{
   Artisan::call('migrate');
   return view('dashboard');
});
Route::get('/migrate/fresh',function ()
{
   Artisan::call('migrate:fresh');
   return view('dashboard');
});
Route::get('/offline', function () {    
    return view('modules/laravelpwa/offline');
    });
