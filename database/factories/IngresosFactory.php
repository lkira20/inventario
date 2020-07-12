<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ingresos;
use App\Persona;
use Faker\Generator as Faker;

$factory->define(Ingresos::class, function (Faker $faker) {
    return [
        //
        'persona_id' => Persona::where('tipo_persona', 'Proveedor')->get()->random()->id,
        'tipo_comprobante' => $faker->randomElement(['Factura', 'Boleta']),
        'serie_comprobante' => $faker->numberBetween(1, 10),
        'num_comprobante' => $faker->numberBetween(1, 60000),
        'fecha_hora' => $faker->dateTime,
        'impuesto' => 18,
        'estado' => 'A'
    ];
});
