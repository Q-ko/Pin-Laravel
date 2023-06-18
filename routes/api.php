<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComentarioController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('listar-clientes', [ClienteController::class, 'index']);

Route::post('registro-cliente', [ClienteController::class, 'store']);

Route::get('ver-cliente/{id}', [ClienteController::class, 'show']);

Route::delete('borrar-cliente/{id}', [ClienteController::class, 'destroy']);

Route::put('activar-cliente', [ClienteController::class, 'activarCliente']);

Route::get('ver-comentarios', [ComentarioController::class, 'index']);