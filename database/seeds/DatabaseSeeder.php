<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

    	DB::table('users')->insert([
    		'name' => Str::random(10),
    		'email' => Str::random(10).'@gmail.com',
    		'password' => Hash::make('password')
    	]);

    	//Para insertar un registro en especifico

    	//para llamar a otros seeder y ejecutarlos
    	$this->call([
    		//UsersTableSeeder::class, 
            CategoriaTableSeeder::class,
    		articulosTableSeeder::class,
            PersonaTableSeeder::class,
            IngresosTableSeeder::class,
            VentaTableSeeder::class,
            articulo_ingresoTableSeeder::class,
            articulo_ventaTableSeeder::class
    	]);
    }
}
