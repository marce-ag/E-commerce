<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Usuario;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function cliente()
    {
        return view('dashboards.cliente');
    }

    public function gerente()
    {
        return view('dashboards.gerente');
    }

    public function administrador()
    {
        // Solo administrador puede ver estadísticas
        Gate::authorize('es-administrador');

        // Total usuarios
        $totalUsuarios    = Usuario::count();
        $totalVendedores  = Usuario::totalVendedores();
        $totalCompradores = Usuario::totalCompradores();

        // Productos por categoría usando Eloquent
        $categorias = Categoria::withCount('productos')->get();

        // Producto más vendido
        $productoMasVendido = Venta::productoMasVendido();

        // Comprador más frecuente
        $compradorMasFrecuente = Venta::compradorMasFrecuente();

        // hasManyThrough — categorías por usuario (vendedor)
        $vendedores = Usuario::where('rol', 'gerente')
            ->with(['productos.categorias'])
            ->get();

        return view('dashboards.administrador', compact(
            'totalUsuarios',
            'totalVendedores',
            'totalCompradores',
            'categorias',
            'productoMasVendido',
            'compradorMasFrecuente',
            'vendedores'
        ));
    }
}
