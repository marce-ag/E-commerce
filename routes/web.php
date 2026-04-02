<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ── Rutas públicas ─────────────────────────────────────────
Route::get('/', fn() => view('public.inicio'))->name('inicio');
Route::get('/quienes-somos', fn() => view('public.quienes-somos'))->name('quienes-somos');
Route::get('/mision-vision', fn() => view('public.mision-vision'))->name('mision-vision');
Route::get('/contacto', fn() => view('public.contacto'))->name('contacto');

// ── Autenticación manual ───────────────────────────────────
Route::get('/login',  [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// ── Rutas protegidas ───────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboards
    Route::get('/dashboard/cliente',       [DashboardController::class, 'cliente'])
        ->name('cliente.dashboard');
    Route::get('/dashboard/gerente',       [DashboardController::class, 'gerente'])
        ->name('gerente.dashboard');
    Route::get('/dashboard/administrador', [DashboardController::class, 'administrador'])
        ->name('admin.dashboard');

    // CRUD usuarios (solo administrador)
    Route::resource('usuarios', UserController::class);
});
