@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
        <h2>Gestión de Usuarios</h2>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">+ Nuevo usuario</a>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;padding:.75rem;border-radius:6px;margin-bottom:1rem">
            {{ session('success') }}
        </div>
    @endif

    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="background:#f3f4f6">
                <th style="padding:.75rem;text-align:left;border-bottom:2px solid #e5e7eb">ID</th>
                <th style="padding:.75rem;text-align:left;border-bottom:2px solid #e5e7eb">Nombre</th>
                <th style="padding:.75rem;text-align:left;border-bottom:2px solid #e5e7eb">Correo</th>
                <th style="padding:.75rem;text-align:left;border-bottom:2px solid #e5e7eb">Rol</th>
                <th style="padding:.75rem;text-align:left;border-bottom:2px solid #e5e7eb">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr style="border-bottom:1px solid #e5e7eb">
                <td style="padding:.75rem">{{ $usuario->id }}</td>
                <td style="padding:.75rem">{{ $usuario->name }}</td>
                <td style="padding:.75rem">{{ $usuario->email }}</td>
                <td style="padding:.75rem">
                    <span style="background:#e0e7ff;color:#3730a3;padding:.2rem .6rem;border-radius:12px;font-size:.85rem">
                        {{ ucfirst($usuario->role) }}
                    </span>
                </td>
                <td style="padding:.75rem">
                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-primary"
                       style="padding:.3rem .8rem;font-size:.85rem">Editar</a>
                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST"
                          style="display:inline"
                          onsubmit="return confirm('¿Eliminar este usuario?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                style="padding:.3rem .8rem;font-size:.85rem">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
