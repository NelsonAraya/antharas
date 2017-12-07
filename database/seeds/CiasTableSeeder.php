<?php

use Illuminate\Database\Seeder;

class CiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new App\Cia();
        $a->numero=1;
        $a->nombre="Cia. Española";
        $a->save();

        $a = new App\Cia();
        $a->numero=2;
        $a->nombre="Cia. Germana";
        $a->save();

        $a = new App\Cia();
        $a->numero=4;
        $a->nombre="Cia. Ausonia";
        $a->save();

        $a = new App\Cia();
        $a->numero=5;
        $a->nombre="Cia. Dalmacia";
        $a->save();

        $a = new App\Cia();
        $a->numero=6;
        $a->nombre="Cia. Stgo. Aldea";
        $a->save();

        $a = new App\Cia();
        $a->numero=7;
        $a->nombre="Cia. Tarapaca";
        $a->save();

        $a = new App\Cia();
        $a->numero=11;
        $a->nombre="Cia. Victoria";
        $a->save();

        $a = new App\Cia();
        $a->numero=12;
        $a->nombre="Cia. Iquique";
        $a->save();

        $a = new App\Cia();
        $a->numero=14;
        $a->nombre="Cia. Guardiamarina Ernesto Riquelme";
        $a->save();
    }
}
