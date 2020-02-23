<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'nom_rol'=>'Activista',
            'desc_rol'=>'Rescatistas, adoptantes y personas que desean ayudar en los refugios.'
            ],[
                'nom_rol'=>'Empresa',
            'desc_rol'=>'Empresas de cualquier rubro que desee ayudar.'
            ],[
                'nom_rol'=>'Refugio',
            'desc_rol'=>'Refugios de gatos y perros.'
            ]
        ]);
    }
}
