<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('size_pets')->insert([
            [
                'size'=>'S',
                'especie'=>'Gatos'
            ],[
                'size'=>'L',
                'especie'=>'Gatos'
            ],[
                'size'=>'XXS',
                'especie'=>'Perros'
            ],[
                'size'=>'XS',
                'especie'=>'Perros'
            ],[
                'size'=>'S',
                'especie'=>'Perros'
            ],[
                'size'=>'M',
                'especie'=>'Perros'
            ],[
                'size'=>'L',
                'especie'=>'Perros'
            ],[
                'size'=>'XL',
                'especie'=>'Perros'
            ],[
                'size'=>'XXL',
                'especie'=>'Perros'
            ]
        ]);
    }
}
