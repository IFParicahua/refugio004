<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoadopcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_adopciones')->insert([
            [
                'nom_estado'=>'negado',
            'desc_estado_adopcion'=>'Su solicitud de adopcion fue negada.'
            ],[
                'nom_estado'=>'Aceptada',
            'desc_estado_adopcion'=>'Su solicitud de adopcion fue aceptada.'
            ],[
                'nom_estado'=>'Procesando',
            'desc_estado_adopcion'=>'Su solicitud de adopcion esta en proceso.'
            ]
        ]);
    }
}
