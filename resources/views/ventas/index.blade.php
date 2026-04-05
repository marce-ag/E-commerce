@extends('layouts.app')
@section('title', 'Ventas')
@section('content')
<div class="bg-white shadow-sm sm:rounded-lg p-6 mb-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Ventas</h2>
        @can('create', App\Models\Venta::class)
            <a href="{{ route('ventas.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                + Nueva venta
            </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-50">
                <th class="p-3 text-left border-b">Producto</th>
                <th class="p-3 text-left border-b">Cliente</th>
                <th class="p-3 text-left border-b">Vendedor</th>
                <th class="p-3 text-left border-b">Fecha</th>
                <th class="p-3 text-left border-b">Total</th>
                <th class="p-3 text-left border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $venta->producto->nombre }}</td>
                <td class="p-3">{{ $venta->cliente->nombre }}</td>
                <td class="p-3">{{ $venta->vendedor->nombre }}</td>
                <td class="p-3">{{ $venta->fecha }}</td>
                <td class="p-3">${{ number_format($venta->total, 2) }}</td>
                <td class="p-3">
                    @can('delete', $venta)
                        <form action="{{ route('ventas.destroy', $venta) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('¿Eliminar esta venta?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
