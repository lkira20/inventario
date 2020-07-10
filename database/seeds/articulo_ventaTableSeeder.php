<?php

use Illuminate\Database\Seeder;
use App\articulo_venta;

class articulo_ventaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(articulo_venta::class, 3)->create();
    }
}
