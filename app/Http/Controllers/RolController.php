<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function getRoles()
    {
        $roles = Rol::all();
        return response()->json($roles, 200);
    }
    public function addRol(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'rol' => 'required|string',
        ]);

        $rol = Rol::create([
            'rol' => $request->rol,
        ]);

        return response()->json($rol, 201);
    }
}
