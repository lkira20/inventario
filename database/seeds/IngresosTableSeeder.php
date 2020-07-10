<?php

use Illuminate\Database\Seeder;
use App\Ingresos;

class IngresosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Ingresos::class, 3)->create();
    }
}
