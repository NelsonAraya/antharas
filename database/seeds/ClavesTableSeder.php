<?php

use Illuminate\Database\Seeder;

class ClavesTableSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new App\Clave();
        $a->clave='10-1';
        $a->descripcion="Llamado Vehicular";
        $a->save();

        $a = new App\Clave();
        $a->clave='10-2';
        $a->descripcion="Llamado Basura";
        $a->save();

        $a = new App\Clave();
        $a->clave='10-0-1';
        $a->descripcion="Llamado Estructural";
        $a->save();
    }
}
