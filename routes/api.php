<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\CidadeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('endereco', [EnderecoController::class, 'store']);

Route::get('endereco', [EnderecoController::class, 'index']);
Route::get('cadastros', [EnderecoController::class, 'mostrarEnderecosEcidades']);

Route::get('endereco/{id}', [EnderecoController::class, 'show']);

Route::put('endereco/{id}', [EnderecoController::class, 'update']);
Route::delete('endereco/{id}', [EnderecoController::class, 'destroy']);

Route::get('cidades', [CidadeController::class, 'index']);
Route::post('cidades', [CidadeController::class, 'store']);
