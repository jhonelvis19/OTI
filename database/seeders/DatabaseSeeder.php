<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            SedesSeeder::class,
            OficinasSeeder::class,
            TiposEquiposSeeder::class,
            TiposIncidenciasSeeder::class,
        ]);
    }
}
