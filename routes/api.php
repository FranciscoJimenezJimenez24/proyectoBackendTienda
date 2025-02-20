<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/productos',[ProductoController::class, 'addProducto']);
Route::put('productos',[ProductoController::class, 'updateProducto']);
Route::delete('productos/{id}',[ProductoController::class, 'deleteProducto']);
Route::get('productos',[ProductoController::class, 'getAllProductos']);
Route::get('productos/{id}',[ProductoController::class, 'getProductoById']);
Route::get('register',[UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);
Route::get('logout',[UserController::class, 'logout']);
Route::get('ventas',[VentaController::class, 'verVentas']);
Route::post('ventas',[VentaController::class, 'registrarVenta']);
Route::post('roles',[RolController::class, 'addRol']);
Route::get('roles',[RolController::class, 'getRoles']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
