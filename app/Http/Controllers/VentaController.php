<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function registrarVenta(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|integer',
            'lista_productos' => 'required|array',
            'total' => 'required|integer',
        ]);    

        $venta = Venta::create([
            'usuario_id' => $request->usuario_id,
            'total' => $request->total,
            'lista_productos' => $request->lista_productos,
        ]);

        return response()->json($venta,201);
    }
}
