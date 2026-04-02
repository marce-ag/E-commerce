@extends('layouts.app')
@section('title', 'Dashboard Administrador')
@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 mb-4">
    <h2 class="text-2xl font-bold text-gray-800">Panel de Administrador</h2>
    <p class="text-gray-500 mt-1">Bienvenido, {{ Auth::user()->nombre }}</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <div class="text-3xl mb-2">👥</div>
        <h3 class="font-semibold text-gray-700 mb-3">Usuarios</h3>
        <a href="{{ route('usuarios.index') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
            Gestionar usuarios
        </a>
    </div>
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <div class="text-3xl mb-2">📦</div>
        <h3 class="font-semibold text-gray-700">Productos</h3>
        <p class="text-gray-400 text-sm">Administrar catálogo</p>
    </div>
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <div class="text-3xl mb-2">📊</div>
        <h3 class="font-semibold text-gray-700">Reportes</h3>
        <p class="text-gray-400 text-sm">Ver estadísticas</p>
    </div>
</div>
@endsection
