<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiporefugioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_refugios')->insert([
            [
            'tipo_refugio'=>'Refugio de gatos'
            ],[
            'tipo_refugio'=>'Refugio de Perros'
            ],[
            'tipo_refugio'=>'Refugio mixto'
            ]
        ]);
    }
}
