<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('admin', function () {
            $role=Auth::user()->role->role;
            return "<?php if ('$role'=='admin') { ?>";
        });
        Blade::directive('sales', function () {
            $role=Auth::user()->role->role;
            return "<?php if ('$role'=='sales') { ?>";
        });
        Blade::directive('other', function () {
            $role=Auth::user()->role->role;
            return "<?php  if ('$role'=='other') { ?>";
        });
        Blade::directive('endrole', function () {
            return "<?php } ?>";
        });
    }
}
