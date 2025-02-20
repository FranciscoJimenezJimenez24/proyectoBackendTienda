<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'rol_id' => 'required|integer',
            'password' => 'required|string|confirmed',
            'token' => 'required|string',
        ]);

        $user = User::create([
            'nombre_user' => $request['nombre_user'],
            'email' => $request['email'],
            'rol_id' => $request['rol_id'],
            'password' => bcrypt($request['password']),
            'token' => $request['token'],
        ]);
        return response()->json(['user' => $user], 200);
    }


    public function login()
    {
        request()->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', request('email'))->first();

        return response()->json($user,200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully.']);
    }
}
