<?php

use Illuminate\Database\Seeder;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new App\Cargo();
        $a->nombre="VOLUNTARIO";
        $a->save();

       	$a = new App\Cargo();
        $a->nombre="DIRECTOR";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="TESORERO CIA";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="SECRETARIO CIA";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="CAPITAN";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="TTE PRIMERO";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="TTE SEGUNDO";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="TTE TERCERO";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="TTE CUARTO";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="MAQUINISTA CIA";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="OTRO CIA";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="AYUDANTE CIA";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="COMANDANTE";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="2° COMANDANTE";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="3° COMANDANTE";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="AYUDANTE GENERAL";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="INSPECTOR CBI";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="SUPERINTENDENTE";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="VICE-SUPERINTENDENTE";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="TESORERO GENERAL";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="SECRETARIO GENERAL";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="ADMINISTRATIVO CBI";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="CONDUCTOR CBI";
        $a->save();

        $a = new App\Cargo();
        $a->nombre="OPERADOR CBI";
        $a->save();
     
    }
}
