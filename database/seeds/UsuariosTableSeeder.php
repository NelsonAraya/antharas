<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = App\Role::where('nombre','adminCBI')->first();
        $role2 = App\Role::where('nombre','rrhh')->first();
        
        $usu = new App\Usuario();
        $usu->id=17096233;
        $usu->dv='8';
        $usu->rol=1967;
        $usu->nombres='Nelson Antonio';
        $usu->apellidop='Araya';
        $usu->apellidom='Vacca';
        $usu->fecha_nacimiento='1989-05-30';
        $usu->telefono=123456;
        $usu->direccion='los chunchos 3474';
        $usu->cia_id=4;
        $usu->cargo_id=1;
        $usu->email='tu@mail.cl';
        $usu->password=bcrypt('antharas');
        $usu->roles()->attach($role);
        $usu->roles()->attach($role2);
        $usu->save();
    }
}
