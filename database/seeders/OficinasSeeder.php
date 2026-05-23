<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OficinasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('oficinas')->insert([

            // ÁREA INGENIERÍAS
            ['nombre' => 'Ciencias Agrarias'],
            ['nombre' => 'Ingeniería Agrícola'],
            ['nombre' => 'Ingeniería Civil y Arquitectura'],
            ['nombre' => 'Ingeniería Económica'],
            ['nombre' => 'Ingeniería Estadística e Informática'],
            ['nombre' => 'Ingeniería de Minas'],
            ['nombre' => 'Ingeniería Geológica'],
            ['nombre' => 'Ingeniería Metalúrgica'],
            ['nombre' => 'Ingeniería Química'],
            ['nombre' => 'Ingeniería de Sistemas'],

            // ÁREA BIOMÉDICAS
            ['nombre' => 'Medicina Veterinaria y Zootecnia'],
            ['nombre' => 'Ciencias Biológicas'],
            ['nombre' => 'Medicina Humana'],
            ['nombre' => 'Enfermería'],
            ['nombre' => 'Nutrición Humana'],
            ['nombre' => 'Odontología'],

            // ÁREA SOCIALES
            ['nombre' => 'Ciencias de la Educación'],
            ['nombre' => 'Ciencias Sociales'],
            ['nombre' => 'Contabilidad y Administración'],
            ['nombre' => 'Derecho y Ciencia Política'],
            ['nombre' => 'Trabajo Social'],
            
            ['nombre' => 'Otros'],
        ]);
    }
}