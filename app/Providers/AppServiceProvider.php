<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\articulo_ingreso;
use App\Observers\articulo_ingresoObserver;
use App\articulo_venta;
use App\Observers\articulo_ventaObserver;
use Illuminate\Support\Facades\Schema;

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
        //
        Schema::defaultStringLength(191);

        articulo_ingreso::observe(articulo_ingresoObserver::class);

        articulo_venta::observe(articulo_ventaObserver::class);
    }
}
