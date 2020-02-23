<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipocuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_cuentas')->insert([
            [
            'nom_tipo_cuenta'=>'facebook'
            ],[
            'nom_tipo_cuenta'=>'instagram'
            ],[
            'nom_tipo_cuenta'=>'youtube'
            ],[
            'nom_tipo_cuenta'=>'twitter'
            ]
        ]);
    }
}
