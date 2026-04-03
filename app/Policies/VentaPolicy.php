<?php

namespace App\Policies;

use App\Models\Venta;
use App\Models\Usuario;

class VentaPolicy
{
    // Ver listado — administrador y gerente
    public function viewAny(Usuario $usuario): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente']);
    }

    // Ver una — administrador, gerente o el cliente dueño
    public function view(Usuario $usuario, Venta $venta): bool
    {
        if ($usuario->esAdministrador() || $usuario->esGerente()) return true;
        return $venta->cliente_id === $usuario->id;
    }

    // Crear — cliente y gerente pueden comprar
    public function create(Usuario $usuario): bool
    {
        return in_array($usuario->rol, ['cliente', 'gerente']);
    }

    // Editar — solo administrador
    public function update(Usuario $usuario, Venta $venta): bool
    {
        return $usuario->esAdministrador();
    }

    // Eliminar — solo administrador
    public function delete(Usuario $usuario, Venta $venta): bool
    {
        return $usuario->esAdministrador();
    }
}
