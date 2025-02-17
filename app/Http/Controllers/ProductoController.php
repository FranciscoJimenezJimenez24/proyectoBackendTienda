<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function addProducto(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string',
            'precio_unidad' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $producto = Producto::create([
            'nombre_producto' => $request->nombre_producto,
            'precio_unidad' => $request->precio_unidad,
            'stock' => $request->stock,
        ]);

        return response()->json($producto, 201);
    }

    public function updateProducto(Request $request)
    {
        $id = $request->id;
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre_producto' => 'required|string',
            'precio_unidad' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $producto->update($request->all());

        return response()->json($producto, 200);
    }

    public function deleteProducto($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json(null, 204);
    }

    public function getAllProductos()
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    public function getProductoById($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            return response()->json($producto, 200);
        }
        return response()->json(['error' => 'Producto not found'], 404);
    }
}
