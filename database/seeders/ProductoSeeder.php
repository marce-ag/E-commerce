<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Usuario::where('correo', 'admin@test.com')->first();

        $productos = [
            [
                'nombre'      => 'Laptop HP',
                'descripcion' => 'Laptop HP 15 pulgadas, 8GB RAM, 256GB SSD',
                'precio'      => 12500.00,
                'existencia'  => 10,
                'categorias'  => [1],
            ],
            [
                'nombre'      => 'Playera deportiva',
                'descripcion' => 'Playera deportiva de algodón talla M',
                'precio'      => 250.00,
                'existencia'  => 50,
                'categorias'  => [2, 4],
            ],
            [
                'nombre'      => 'Lámpara de escritorio',
                'descripcion' => 'Lámpara LED regulable para escritorio',
                'precio'      => 399.00,
                'existencia'  => 20,
                'categorias'  => [3],
            ],
            [
                'nombre'      => 'El principito',
                'descripcion' => 'Novela clásica de Antoine de Saint-Exupéry',
                'precio'      => 120.00,
                'existencia'  => 30,
                'categorias'  => [5],
            ],
            [
                'nombre'      => 'Balón de fútbol',
                'descripcion' => 'Balón oficial tamaño 5',
                'precio'      => 350.00,
                'existencia'  => 15,
                'categorias'  => [4],
            ],
        ];

        foreach ($productos as $data) {
            $categorias = $data['categorias'];
            unset($data['categorias']);

            $producto = Producto::create([
                ...$data,
                'usuario_id' => $admin->id,
            ]);

            $producto->categorias()->sync($categorias);
        }
    }
}
