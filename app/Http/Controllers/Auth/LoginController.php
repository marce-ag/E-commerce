<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Muestra el formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesa el login
    public function login(Request $request)
    {
        $request->validate([
            'correo'   => 'required|email',
            'clave'    => 'required',
        ]);

        $credenciales = [
            'correo' => $request->correo,
            'password' => $request->clave,
        ];

        if (Auth::attempt($credenciales, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $usuario = Auth::user();

            // Bitácora — login exitoso
            Log::channel('autenticacion')->info('Login exitoso', [
                'usuario_id' => $usuario->id,
                'correo'     => $usuario->correo,
                'ip'         => $request->ip(),
            ]);

            // Redirige según el rol
            return match ($usuario->rol) {
                'administrador' => redirect()->route('admin.dashboard'),
                'gerente'       => redirect()->route('gerente.dashboard'),
                default         => redirect()->route('cliente.dashboard'),
            };
        }

        // Bitácora — login fallido
        Log::channel('autenticacion')->warning('Login fallido', [
            'correo' => $request->correo,
            'ip'     => $request->ip(),
        ]);

        return back()->withErrors([
            'correo' => 'Las credenciales no son correctas.',
        ])->onlyInput('correo');
    }

    // Cierra sesión
    public function logout(Request $request)
    {
        $usuario = Auth::user();

        Log::channel('autenticacion')->info('Logout', [
            'usuario_id' => $usuario->id,
            'correo'     => $usuario->correo,
            'ip'         => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
