<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('razas')->insert([
            [
                'nom_raza'=>'Mestizo',
                'especie'=>'general',
                'desc_raza'=>'Ascendencia desconocida.'
            ],[
                'nom_raza'=>'Labrador retriever',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Husky siberiano',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Pug',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Pomeranian',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Bulldog',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Shiba Inu',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Golden retriever',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Poodle',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Chihuahua',
                'especie'=>'canino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Persa',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Bengala',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Siames',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Maine Coon',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Sphynx',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'British Shorthair',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Azul ruso',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Ragdoll',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ],[
                'nom_raza'=>'Munchkin',
                'especie'=>'felino',
                'desc_raza'=>'Descripcion en espera.'
            ]
        ]);
    }
}
