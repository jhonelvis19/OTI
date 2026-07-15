<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Deshabilitar FK checks para poder truncar sin errores de constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        User::create([
            'name'     => 'Administrador',
            'apellido' => 'Sistema',
            'email'    => 'admin@oti.com',
            'password' => Hash::make('Admin1234'),
            'rol'      => 'admin',
        ]);

        User::create([
            'name'     => 'Técnico',
            'apellido' => 'Soporte',
            'email'    => 'tecnico@oti.com',
            'password' => Hash::make('Tecnico1234'),
            'rol'      => 'usuario',
        ]);
    }
}
