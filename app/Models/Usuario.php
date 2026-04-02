<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'clave',
        'rol',
    ];

    protected $hidden = [
        'clave',
        'remember_token',
    ];

    // Le decimos a Laravel qué campo es el password
    public function getAuthPassword()
    {
        return $this->clave;
    }

    // Helpers de rol
    public function esAdministrador(): bool
    {
        return $this->rol === 'administrador';
    }

    public function esGerente(): bool
    {
        return $this->rol === 'gerente';
    }

    public function esCliente(): bool
    {
        return $this->rol === 'cliente';
    }



    public function getAuthIdentifierName()
    {
        return 'correo';
    }



}
