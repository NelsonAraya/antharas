<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new App\Role();
		$a->nombre = 'rrhh';
		$a->descripcion = 'Modulos RRHH';
		$a->save();

		$a = new App\Role();
		$a->nombre = 'activacion';
		$a->descripcion = 'Modulos Activacion';
		$a->save();

		$a = new App\Role();
		$a->nombre = 'adminCBI';
		$a->descripcion = 'Modulos AdminCBI';
		$a->save();

		$a = new App\Role();
		$a->nombre = 'adminCIA';
		$a->descripcion = 'Modulos AdminCIA';
		$a->save();

		$a = new App\Role();
		$a->nombre = 'bitacora';
		$a->descripcion = 'Modulos Bitacoras';
		$a->save();

		$a = new App\Role();
		$a->nombre = 'partes';
		$a->descripcion = 'Modulos Partes';
		$a->save();

		$a = new App\Role();
		$a->nombre = 'emergencia';
		$a->descripcion = 'Modulos de Emergencias';
		$a->save();

		$a = new App\Role();
		$a->nombre = 'ficha';
		$a->descripcion = 'Modulos de Ficha Medica';
		$a->save();

		$a = new App\Role();
		$a->nombre = 'tono';
		$a->descripcion = 'Modulos de Tonos';
		$a->save();
    }
}
