<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposIncidenciasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_incidencias')->insert([
            ['nombre' => 'Internet'],
            ['nombre' => 'Software'],
            ['nombre' => 'Hardware'],
            ['nombre' => 'Otros'],
        ]);
    }
}