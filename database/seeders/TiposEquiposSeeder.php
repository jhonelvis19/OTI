<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposEquiposSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_equipos')->insert([
            ['nombre' => 'Laptop'],
            ['nombre' => 'Impresora'],
            ['nombre' => 'Monitor'],
            ['nombre' => 'all in one'],
            ['nombre' => 'proyector'],
            ['nombre' => 'Otros'],
        ]);
    }
}