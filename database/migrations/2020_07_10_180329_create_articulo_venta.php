<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticuloVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_venta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('venta_id');
            $table->integer('articulo_id');
            $table->integer('cantidad');
            $table->decimal('precio_venta',11,2);
            $table->decimal('descuento', 11, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo_venta');
    }
}
