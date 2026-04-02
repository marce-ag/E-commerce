@extends('layouts.app')
@section('title', 'Dashboard Cliente')
@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 mb-4">
    <h2 class="text-2xl font-bold text-gray-800">Panel de Cliente</h2>
    <p class="text-gray-500 mt-1">Bienvenido, {{ Auth::user()->name }}</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <div class="text-3xl mb-2">🛍️</div>
        <h3 class="font-semibold text-gray-700">Mis pedidos</h3>
        <p class="text-gray-400 text-sm">Ver historial de compras</p>
    </div>
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <div class="text-3xl mb-2">❤️</div>
        <h3 class="font-semibold text-gray-700">Lista de deseos</h3>
        <p class="text-gray-400 text-sm">Productos guardados</p>
    </div>
    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <div class="text-3xl mb-2">👤</div>
        <h3 class="font-semibold text-gray-700">Mi perfil</h3>
        <p class="text-gray-400 text-sm">Editar mis datos</p>
    </div>
</div>
@endsection
