<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\articulo_ingreso;
use App\Ingresos;
use App\Articulo;
use Faker\Generator as Faker;

$factory->define(articulo_ingreso::class, function (Faker $faker) {
    return [
        //
        'ingreso_id' => Ingresos::all()->random()->id,
        'articulo_id' => Articulo::where('estado', 'Activo')->get()->random()->id,
        'cantidad' => $faker->numberBetween(1, 50),
        'precio_compra' => $faker->randomFloat(2,1,1000),
        'precio_venta' => $faker->randomFloat(2,1,1000)
    ];
});
