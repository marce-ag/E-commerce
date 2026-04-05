<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador fijo
        Usuario::create([
            'nombre'    => 'Admin',
            'apellidos' => 'Sistema',
            'correo'    => 'admin@test.com',
            'clave'     => Hash::make('123'),
            'rol'       => 'administrador',
        ]);

        // 5 usuarios aleatorios con el factory
        Usuario::factory(5)->create();
    }
}
