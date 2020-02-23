<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipohorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_horarios')->insert([
            [
                'nom_tipo_horario'=>'única vez',
            ],[
                'nom_tipo_horario'=>'diario',
            ],[
                'nom_tipo_horario'=>'semanal',
            ],[
                'nom_tipo_horario'=>'personalizado',
            ]
        ]);
    }
}
