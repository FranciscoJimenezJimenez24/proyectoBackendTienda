<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{

    public function verVentas()
    {
        $ventas = Venta::all();
        return response()->json($ventas, 200);
    }
    public function registrarVenta(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|integer',
            'lista_productos' => 'required|array',
            'total' => 'required|integer',
            'estado_venta' => 'required|string',
        ]);

        $venta = Venta::create([
            'usuario_id' => $request->usuario_id,
            'total' => $request->total,
            'lista_productos' => $request->lista_productos,
            'estado_venta' => $request->estado_venta,
        ]);

        return response()->json($venta, 201);
    }

    public function updateVenta(Request $request)
    {
        $id = $request->id;
        $venta = Venta::find($id);
        if ($venta) {
            $venta->update($request->all());
            return response()->json($venta, 200);
        } else {
            return response()->json(['error' => 'No se encontró la venta'], 404);
        }
    }
}
