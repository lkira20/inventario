<?php

namespace App\Observers;

use App\articulo_venta;
use App\Articulo;
class articulo_ventaObserver
{
    /**
     * Handle the articulo_venta "created" event.
     *
     * @param  \App\articulo_venta  $articuloVenta
     * @return void
     */
    public function created(articulo_venta $articuloVenta)
    {
        //
        $articulo = Articulo::findOrFail($articuloVenta->articulo_id);

        $articulo->stock = $articulo->stock - $articuloVenta->cantidad;

        $articulo->update();
    }

    /**
     * Handle the articulo_venta "updated" event.
     *
     * @param  \App\articulo_venta  $articuloVenta
     * @return void
     */
    public function updated(articulo_venta $articuloVenta)
    {
        //
    }

    /**
     * Handle the articulo_venta "deleted" event.
     *
     * @param  \App\articulo_venta  $articuloVenta
     * @return void
     */
    public function deleted(articulo_venta $articuloVenta)
    {
        //
    }

    /**
     * Handle the articulo_venta "restored" event.
     *
     * @param  \App\articulo_venta  $articuloVenta
     * @return void
     */
    public function restored(articulo_venta $articuloVenta)
    {
        //
    }

    /**
     * Handle the articulo_venta "force deleted" event.
     *
     * @param  \App\articulo_venta  $articuloVenta
     * @return void
     */
    public function forceDeleted(articulo_venta $articuloVenta)
    {
        //
    }
}
