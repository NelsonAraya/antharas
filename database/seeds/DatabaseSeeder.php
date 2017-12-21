<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(CargosTableSeeder::class);
        $this->call(CiasTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        $this->call(VehiculosTableSeeder::class);
        $this->call(ClavesTableSeder::class);

    }
}
