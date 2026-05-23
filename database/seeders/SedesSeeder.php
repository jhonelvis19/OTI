<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sedes')->insert([
            ['nombre' => 'CEDE'],
            ['nombre' => 'CU'],
            ['nombre' => 'Ed. Cont.'],
            ['nombre' => 'Cen. Idioma'],
            ['nombre' => 'Otros'],
        ]);
    }
}