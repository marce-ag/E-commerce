@extends('layouts.app')
@section('title', 'Editar Usuario')
@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Usuario</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Correo</label>
            <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-1">Rol</label>
            <select name="role" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <option value="cliente"  {{ old('role', $usuario->role)=='cliente'  ? 'selected' : '' }}>Cliente</option>
                <option value="empleado" {{ old('role', $usuario->role)=='empleado' ? 'selected' : '' }}>Empleado</option>
                <option value="gerente"  {{ old('role', $usuario->role)=='gerente'  ? 'selected' : '' }}>Gerente</option>
            </select>
        </div>
        <div class="flex gap-3">
            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                Actualizar
            </button>
            <a href="{{ route('usuarios.index') }}"
               class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
