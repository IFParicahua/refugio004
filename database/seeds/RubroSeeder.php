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
                'desc_rubro'=>'Tecnologia'
            ],[
                'desc_rubro'=>'Ropa'
            ],[
                'desc_rubro'=>'Alimentos'
            ],[
                'desc_rubro'=>'Gastronomico'
            ],[
                'desc_rubro'=>'Entretenimiento'
            ],[
                'desc_rubro'=>'Gastronomico'
            ],[
                'desc_rubro'=>'Accesorios'
            ]
        ]);
    }
}
