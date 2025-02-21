<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Mockery\Undefined;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'rol_id' => 'required|integer',
            'password' => 'required|string',
            'token' => 'nullable|string',
        ]);

        $user = User::create([
            'nombre_user' => $request['nombre_user'],
            'email' => $request['email'],
            'rol_id' => $request['rol_id'],
            'password' => bcrypt($request['password']),
            'token' => $request['token'],
        ]);
        if (!$user) {
            return response()->json(['message' => 'No se pudo registrar el usuario'], 404);
        }else{
            return response()->json(['message' => 'Usuario registrado correctamente'], 200);
        }
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'nombre_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'rol_id' => 'required|integer',
            'password' => 'required|string',
            'token' => 'required|string',
        ]);

        $user = User::find($request['id']);
        if (!$user) {
            return response()->json(['message' => 'No se encontró el usuario'], 404);
        } else {
            $user->nombre_user = $request['nombre_user'];
            $user->email = $request['email'];
            $user->rol_id = $request['rol_id'];
            $user->password = bcrypt($request['password']);
            $user->token = $request['token'];
            $user->save();
            return response()->json(['user' => $user], 200);
        }
    }


    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(null,200);
        } else {
            return response()->json([
                'id' => $user->id,
                'nombre_user' => $user->nombre_user,
                'email' => $user->email,
                'rol_id' => $user->rol_id,
                'token' => $user->token,
                'password' => $password, 
            ], 200);
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully.']);
    }
}
