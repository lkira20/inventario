<?php

use Illuminate\Database\Seeder;
use App\articulo_ingreso;

class articulo_ingresoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(articulo_ingreso::class, 3)->create();
    }
}
