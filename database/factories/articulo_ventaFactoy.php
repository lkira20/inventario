<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\articulo_venta;
use App\Ingresos;
use App\Articulo;
use Faker\Generator as Faker;

$factory->define(articulo_venta::class, function (Faker $faker) {
    return [
        //
        'venta_id' => Ingresos::all()->random()->id,
        'articulo_id' => Articulo::where('estado', 'Activo')->get()->random()->id,
        'cantidad' => $faker->numberBetween(1, 50),
        'precio_venta' => $faker->randomFloat(2),
        'descuento' => $faker->randomFloat(2, 1 , 10)
    ];
});
