<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadoadopcionSeeder::class);
        $this->call(EstadomascotaSeeder::class);
        $this->call(RazaSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(RubroSeeder::class);
        $this->call(TipocuentaSeeder::class);
        $this->call(TiporefugioSeeder::class);
        $this->call(TipohorarioSeeder::class);
        $this->call(SizeSeeder::class);

    }
}
