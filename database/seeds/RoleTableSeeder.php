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
		$a->estado=1;
		$a->save();

		$a = new App\Role();
		$a->nombre = 'activacion';
		$a->descripcion = 'Modulos Activacion';
		$a->estado=1;
		$a->save();

		$a = new App\Role();
		$a->nombre = 'adminCBI';
		$a->descripcion = 'Modulos AdminCBI';
		$a->estado=1;
		$a->save();

		$a = new App\Role();
		$a->nombre = 'adminCIA';
		$a->descripcion = 'Modulos AdminCIA';
		$a->estado=1;
		$a->save();

		$a = new App\Role();
		$a->nombre = 'bitacora';
		$a->descripcion = 'Modulos Bitacoras';
		$a->estado=1;
		$a->save();

		$a = new App\Role();
		$a->nombre = 'partes';
		$a->descripcion = 'Modulos Partes';
		$a->estado=1;
		$a->save();

		$a = new App\Role();
		$a->nombre = 'emergencia';
		$a->descripcion = 'Modulos de Emergencias';
		$a->estado=1;
		$a->save();

		$a = new App\Role();
		$a->nombre = 'ficha';
		$a->descripcion = 'Modulos de Ficha Medica';
		$a->estado=1;
		$a->save();

		$a = new App\Role();
		$a->nombre = 'tono';
		$a->descripcion = 'Modulos de Tonos';
		$a->estado=1;
		$a->save();
    }
}
