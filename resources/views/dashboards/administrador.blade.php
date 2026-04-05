@extends('layouts.app')
@section('title', 'Dashboard Administrador')
@section('content')

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 mb-4">
    <h2 class="text-2xl font-bold text-gray-800">Panel de Administrador</h2>
    <p class="text-gray-500 mt-1">Bienvenido, {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

    <a href="{{ route('usuarios.index') }}"
       class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition block">
        <div class="text-4xl mb-3">👥</div>
        <h3 class="font-semibold text-gray-800 text-lg mb-1">Usuarios</h3>
        <p class="text-gray-400 text-sm">Crear, editar y eliminar usuarios</p>
    </a>

    <a href="{{ route('productos.index') }}"
       class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition block">
        <div class="text-4xl mb-3">📦</div>
        <h3 class="font-semibold text-gray-800 text-lg mb-1">Productos</h3>
        <p class="text-gray-400 text-sm">Gestionar catálogo de productos</p>
    </a>

    <a href="{{ route('categorias.index') }}"
       class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition block">
        <div class="text-4xl mb-3">🏷️</div>
        <h3 class="font-semibold text-gray-800 text-lg mb-1">Categorías</h3>
        <p class="text-gray-400 text-sm">Administrar categorías</p>
    </a>

    <a href="{{ route('ventas.index') }}"
       class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition block">
        <div class="text-4xl mb-3">💰</div>
        <h3 class="font-semibold text-gray-800 text-lg mb-1">Ventas</h3>
        <p class="text-gray-400 text-sm">Ver y gestionar ventas</p>
    </a>

</div>
@endsection
