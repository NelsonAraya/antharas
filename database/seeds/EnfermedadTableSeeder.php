<?php

use Illuminate\Database\Seeder;

class EnfermedadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new App\Enfermedad();
		$a->nombre = 'Hipertension';
		$a->save();

        $a = new App\Enfermedad();
        $a->nombre = 'Diabetes Tipo 1';
        $a->save();

        $a = new App\Enfermedad();
        $a->nombre = 'Diabetes Tipo 2';
        $a->save();

        $a = new App\Enfermedad();
        $a->nombre = 'Dislipidemia';
        $a->save();

        $a = new App\Enfermedad();
        $a->nombre = 'Asma Bronquial';
        $a->save();

        $a = new App\Enfermedad();
        $a->nombre = 'Pulmonar Obstructiva Cronica (EPOC)';
        $a->save();

        $a = new App\Enfermedad();
        $a->nombre = 'Cancer';
        $a->save();
        
        $a = new App\Enfermedad();
        $a->nombre = 'Hipoteroidismo';
        $a->save();
        
        $a = new App\Enfermedad();
        $a->nombre = 'Hiperteroidismo';
        $a->save();
        
        $a = new App\Enfermedad();
        $a->nombre = 'Insuficiencia Cardiaca';
        $a->save();

        $a = new App\Enfermedad();
        $a->nombre = 'Insuficiencia Renal';
        $a->save();

        $a = new App\Enfermedad();
        $a->nombre = 'Infarto Agudo al Miocardio (IAM)';
        $a->save();
    }
}
