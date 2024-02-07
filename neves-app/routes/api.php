<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DescontoController;
use App\Http\Controllers\ImagensController;
use App\Http\Controllers\ImagensProdutoController;
use App\Http\Controllers\OcasiaoController;
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

Route::apiResource('produto', ProdutoController::class);
Route::apiResource('desconto', DescontoController::class);
Route::apiResource('imagens', ImagensController::class);
Route::apiResource('imagens_produto', ImagensProdutoController::class);
Route::apiResource('ocasiao', OcasiaoController::class);

Route::post('categoria', [CategoriaController::class, 'store']);
Route::patch('categoria/{categoria}', [CategoriaController::class, 'update']);
Route::get('categoria', [CategoriaController::class, 'show']);
Route::delete('categoria/{categoria}', [CategoriaController::class, 'delete']);

Route::post('materia', [MateriaPrimaController::class, 'store']);
Route::patch('materia/{materia}', [MateriaPrimaController::class, 'update']);
Route::get('materia', [MateriaPrimaController::class, 'show']);
Route::delete('materia/{materia}', [MateriaPrimaController::class, 'delete']);