<?php

namespace App\Providers;

use App\Models\Cash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use ConsoleTVs\Charts\Registrar as Charts;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
     
        $charts->register([
            \App\Charts\SalesChart::class
        ]);
      
    }
}
