<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{

    public function verVentas()
    {
        $ventas = Venta::where('estado_venta', 'finalizado')->get();
        if ($ventas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron ventas'], 404);
        }else{
            return response()->json($ventas, 200);
        }
    }
    public function registrarVenta(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|integer',
            'lista_productos' => 'required|array',
            'total' => 'required|integer',
            'estado_venta' => 'required|string',
        ]);

        $venta = Venta::create([
            'id_usuario' => $request->id_usuario,
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

    public function deleteVenta($id)
    {
        $venta = Venta::find($id);
        if ($venta) {
            $venta->delete();
            return response()->json(['message' => 'Venta eliminada'], 200);
        } else {
            return response()->json(['error' => 'No se encontró la venta'], 404);
        }
    }

    public function verVentasPorUsuario($id_usuario)
    {
        $ventas = Venta::where('id_usuario', $id_usuario)
            ->where('estado_venta', 'curso')
            ->get();
        if ($ventas->isEmpty()) {
            return response()->json( null,200);
        }else{
            return response()->json($ventas, 200);
        }
    }
}
