<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Http\Requests\StoreVentaRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Venta::class);

        $usuario = Auth::user();

        if ($usuario->esCliente()) {
            // Cliente solo ve sus propias ventas
            $ventas = Venta::with('producto', 'cliente', 'vendedor')
                ->where('cliente_id', $usuario->id)
                ->get();
        } else {
            // Gerente y administrador ven todas
            $ventas = Venta::with('producto', 'cliente', 'vendedor')->get();
        }

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        // Verificamos manualmente el rol
        $usuario = Auth::user();
        if (!in_array($usuario->rol, ['cliente', 'gerente', 'administrador'])) {
            abort(403);
        }

        $productos = Producto::where('existencia', '>', 0)->get();
        return view('ventas.create', compact('productos'));
    }

    public function store(StoreVentaRequest $request)
    {
        $producto = \App\Models\Producto::findOrFail($request->producto_id);

        // Verificar que haya suficiente existencia
        if ($producto->existencia < $request->cantidad) {
            return back()->withErrors([
                'cantidad' => 'No hay suficiente existencia. Solo quedan ' . $producto->existencia . ' unidades.'
            ])->withInput();
        }

        $venta = Venta::create([
            'producto_id' => $request->producto_id,
            'vendedor_id' => $producto->usuario_id,
            'cliente_id'  => Auth::user()->id,
            'fecha'       => $request->fecha,
            'total'       => $request->total,
        ]);

        // Descontar existencia
        $producto->decrement('existencia', $request->cantidad);

        Log::channel('ventas')->info('Venta creada', [
            'venta_id'    => $venta->id,
            'producto_id' => $venta->producto_id,
            'cantidad'    => $request->cantidad,
            'total'       => $venta->total,
            'usuario_id'  => Auth::user()->id,
        ]);

        return redirect()->route('productos.index')
            ->with('success', '¡Compra realizada exitosamente!');
    }

    public function destroy(Venta $venta)
    {
        $this->authorize('delete', $venta);
        $venta->delete();
        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada.');
    }
}
