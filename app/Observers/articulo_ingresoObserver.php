<?php

namespace App\Observers;

use App\articulo_ingreso;
use App\Articulo;

class articulo_ingresoObserver
{
    /**
     * Handle the articulo_ingreso "created" event.
     *
     * @param  \App\articulo_ingreso  $articuloIngreso
     * @return void
     */
    public function created(articulo_ingreso $articuloIngreso)
    {
        //
        $articulo = Articulo::findOrFail($articuloIngreso->articulo_id);

        $articulo->stock = $articulo->stock + $articuloIngreso->cantidad;

        $articulo->update();
    }

    /**
     * Handle the articulo_ingreso "updated" event.
     *
     * @param  \App\articulo_ingreso  $articuloIngreso
     * @return void
     */
    public function updated(articulo_ingreso $articuloIngreso)
    {
        //
    }

    /**
     * Handle the articulo_ingreso "deleted" event.
     *
     * @param  \App\articulo_ingreso  $articuloIngreso
     * @return void
     */
    public function deleted(articulo_ingreso $articuloIngreso)
    {
        //
    }

    /**
     * Handle the articulo_ingreso "restored" event.
     *
     * @param  \App\articulo_ingreso  $articuloIngreso
     * @return void
     */
    public function restored(articulo_ingreso $articuloIngreso)
    {
        //
    }

    /**
     * Handle the articulo_ingreso "force deleted" event.
     *
     * @param  \App\articulo_ingreso  $articuloIngreso
     * @return void
     */
    public function forceDeleted(articulo_ingreso $articuloIngreso)
    {
        //
    }
}
