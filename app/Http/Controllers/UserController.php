<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
        Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_user');
        $table->string('email');
        $table->foreignId('rol_id')->constrained();
        $table->string('token');
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
    */
    public function register(Request $request)
    {
        $request->validate([
            'nombre_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'rol_id' => 'required|integer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nombre_user' => $request['nombre_user'],
            'email' => $request['email'],
            'rol_id' => $request['rol_id'],
            'password' => bcrypt($request['password']),
        ]);

        $token = $user->createUserToken();

        $userWithToken = $user->only(['id', 'nombre_user', 'email', 'rol_id']);
        $userWithToken['token'] = $token;

        return response()->json(['user' => $userWithToken], 200);
    }


    public function login()
    {
        request()->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', request('email'))->first();

        if (!$user || !password_verify(request('password'), $user->password)) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }

        return response()->json([
            'user' => $user->only(['id', 'nombre_user', 'email', 'rol_id']),
            'access_token' => $user->token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully.']);
    }
}
