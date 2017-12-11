<?php

use Illuminate\Database\Seeder;

class VehiculosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new App\Vehiculo();
        $a->patente='XD-96-88';
        $a->clave="B5";
        $a->modelo="EUROFIGHTER";
        $a->marca="MAGIRUS";
        $a->anio=2018;
        $a->estado='A';
        $a->cia_id=4;
        $a->save();

        $a = new App\Vehiculo();
        $a->patente='XD-QW-88';
        $a->clave="Q5";
        $a->modelo="GALIER";
        $a->marca="TECHNIQUE SUPLIES";
        $a->anio=2007;
        $a->estado='A';
        $a->cia_id=4;
        $a->save();

        $a = new App\Vehiculo();
        $a->patente='XD-QQ-88';
        $a->clave="R2";
        $a->modelo="EUROFIGHTER";
        $a->marca="MAGIRUS";
        $a->anio=2018;
        $a->estado='A';
        $a->cia_id=2;
        $a->save();
    }
}
