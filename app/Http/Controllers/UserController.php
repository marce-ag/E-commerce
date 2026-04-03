<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // Formulario para crear usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:cliente,empleado,gerente',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    // Formulario para editar
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    // Guardar cambios
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'role'  => 'required|in:cliente,empleado,gerente',
        ]);

        $usuario->update($request->only('name', 'email', 'role'));

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado.');
    }

    // Eliminar usuario
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado.');
    }
}
