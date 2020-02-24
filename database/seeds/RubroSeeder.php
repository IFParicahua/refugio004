<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RubroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rubros')->insert([
            [
                'desc_rubro'=>'Restaurante'
            ],[
                'desc_rubro'=>'Servicio de textileria o venta de ropa'
            ],[
                'desc_rubro'=>'Articulos y servicios para la mascota'
            ],[
                'desc_rubro'=>'Arte y Entretenimiento'
            ],[
                'desc_rubro'=>'Veterinaria'
            ],[
                'desc_rubro'=>'Agencia de viajes y turismo'
            ],[
                'desc_rubro'=>'Bancos'
            ],[
                'desc_rubro'=>'Servicio de comida rapida'
            ],[
                'desc_rubro'=>'Cafetería'
            ],[
                'desc_rubro'=>'Heladería'
            ],[
                'desc_rubro'=>'Panadería o Pastelería'
            ],[
                'desc_rubro'=>'Dentista'
            ],[
                'desc_rubro'=>'Florería'
            ],[
                'desc_rubro'=>'Servicio de catering'
            ],[
                'desc_rubro'=>'Universidades'
            ],[
                'desc_rubro'=>'Belleza y cuidado cuidado personal'
            ]
        ]);
    }
}
