<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

   
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
        //Rutas de Api
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

        //Rutas web predeterminada
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

        //Rutas de personas
            Route::middleware(['web', 'auth:sanctum'])
                ->prefix('persons')
                ->namespace($this->namespace)
                ->group(base_path('routes/persons.php'));
        
            //Rutas de inventario
            Route::middleware(['web', 'auth:sanctum'])
                ->prefix('inventory')
                ->namespace($this->namespace)
                ->group(base_path('routes/inventory.php'));

            //Rutas de factura
            Route::middleware(['web', 'auth:sanctum'])
                ->prefix('invoice')
                ->namespace($this->namespace)
                ->group(base_path('routes/invoice.php'));

            //Rutas fiscales
            Route::middleware(['web', 'auth:sanctum'])
                ->prefix('fiscal')
                ->namespace($this->namespace)
                ->group(base_path('routes/fiscal.php'));
            
            //Rutas de cuentas
            Route::middleware(['web', 'auth:sanctum'])
                ->prefix('account')
                ->namespace($this->namespace)
                ->group(base_path('routes/account.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
