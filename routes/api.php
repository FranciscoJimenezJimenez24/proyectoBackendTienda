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
Route::post('producto/add',[ProductoController::class, 'addProducto']);
Route::put('producto/edit',[ProductoController::class, 'updateProducto']);
Route::delete('producto/delete/{id}',[ProductoController::class, 'deleteProducto']);
Route::get('producto/all',[ProductoController::class, 'getAllProductos']);
Route::get('producto/{id}',[ProductoController::class, 'getProductoById']);
Route::post('user/add',[UserController::class, 'register']);
Route::post('user/edit',[UserController::class, 'updateUser']);
Route::get('email/{email}/password/{password}',[UserController::class, 'login']);
Route::get('logout',[UserController::class, 'logout']);
Route::get('venta/curso/{id_usuario}',[VentaController::class, 'verVentasPorUsuario']);
Route::get('venta/finalizada',[VentaController::class, 'verVentas']);
Route::post('venta/add',[VentaController::class, 'registrarVenta']);
Route::put('venta/edit',[VentaController::class, 'updateVenta']);
Route::put('venta/delete/{id}',[VentaController::class, 'deleteVenta']);
Route::post('roles',[RolController::class, 'addRol']);
Route::get('roles',[RolController::class, 'getRoles']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
