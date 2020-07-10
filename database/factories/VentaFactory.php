<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Venta;
use App\Persona;
use Faker\Generator as Faker;

$factory->define(Venta::class, function (Faker $faker) {

    return [
        //
        'persona_id' => Persona::where('tipo_persona', 'Cliente')->get()->random()->id,
        'tipo_comprobante' => $faker->randomElement(['Factura', 'Boleta']),
        'serie_comprobante' => $faker->numberBetween(1, 10),
        'num_comprobante' => $faker->numberBetween(1, 60000),
        'fecha_hora' => $faker->dateTime,
        'impuesto' => 18,
        'total_venta' => $faker->randomFloat(2),
        'estado' => 'A'
    ];
});
