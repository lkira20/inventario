<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articulo;
use App\Categoria;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Articulo::class, function (Faker $faker) {
    return [
    	'categoria_id' => Categoria::all()->random()->id,
        'codigo' => Uuid::generate()->string,
        'nombre' => $faker->name,
        'stock' => 1,
        'descripcion' => $faker->text(50),
        'imagen' => $faker->fileExtension,//revisar como usar file
        'estado' => 'activo',


    ];
});
