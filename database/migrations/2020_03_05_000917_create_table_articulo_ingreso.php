<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableArticuloIngreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_ingreso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ingreso_id');
            $table->integer('articulo_id');
            $table->integer('cantidad');
            $table->decimal('precio_compra');
            $table->decimal('precio_venta');
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
        Schema::dropIfExists('articulo_ingreso');
    }
}
