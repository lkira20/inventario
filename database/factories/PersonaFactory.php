<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Persona;
use Faker\Generator as Faker;

$factory->define(Persona::class, function (Faker $faker) {
    return [
        //
        'tipo_persona' => $faker->randomElement(['Cliente', 'Proveedor']),
        'nombre' => $faker->name,
        'tipo_documento' => $faker->randomElement(['Cedula', 'RUC', 'DNI']),
        'num_documento' => $faker->numberBetween(10000000, 30000000),
        'direccion' => $faker->address,
        'telefono' => $faker->e164phoneNumber,
        'email' => $faker->safeEmail

    ];
});
