<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadomascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_mascotas')->insert([
            [
                'nom_estado_mascota'=>'Evaluacion medica',
            'desc_estado_mascota'=>'La mascota esta siendo revisada por seguridad.'
            ],[
                'nom_estado_mascota'=>'Cuarentena',
            'desc_estado_mascota'=>'Tiempo de adaptacion y evalucaion de la mascota.'
            ],[
                'nom_estado_mascota'=>'Adopcion',
            'desc_estado_mascota'=>'Su solicitud de adopcion esta en proceso.'
            ]
        ]);
    }
}
