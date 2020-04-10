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
                'nom_estado_mascota'=>'Chequeo',
            'desc_estado_mascota'=>'La mascota esta siendo revisada por seguridad.',
            'icon'=>'052-veterinary.png'
            ],[
                'nom_estado_mascota'=>'Cuarentena',
            'desc_estado_mascota'=>'Tiempo de adaptacion y evalucaion de la mascota.',
            'icon'=>'052-cuarent.png'
            ],[
                'nom_estado_mascota'=>'Adaptación',
            'desc_estado_mascota'=>'Adaptación antes de entrar en adopción.',
            'icon'=>'052-harness.png'
            ],[
                'nom_estado_mascota'=>'En Adopción',
            'desc_estado_mascota'=>'La mascota se encuentra lista para ser adoptada.',
            'icon'=>'052-pet.png'
            ],[
                'nom_estado_mascota'=>'Adoptados',
            'desc_estado_mascota'=>'La mascota se encuentra en su nuevo hogar.',
            'icon'=>'011-collar.png'
            ]
        ]);
    }
}
