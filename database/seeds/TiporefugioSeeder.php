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
            'tipo_refugio'=>'Gatos'
            ],[
            'tipo_refugio'=>'Perros'
            ],[
            'tipo_refugio'=>'Mixto'
            ]
        ]);
    }
}
