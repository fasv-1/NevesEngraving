<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DescontoController;
use App\Http\Controllers\ImagensController;
use App\Http\Controllers\ImagensProdutoController;
use App\Http\Controllers\OcasiaoController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UserReviewsController;
use App\Http\Controllers\UserFavoritesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProdutoDetalheController;
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

// Route::middleware('auth:sanctum', 'ability:Profile-acess,App-manage')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('produto', ProdutoController::class);
Route::apiResource('desconto', DescontoController::class);
Route::apiResource('imagens_produto', ImagensProdutoController::class);
Route::apiResource('ocasiao', OcasiaoController::class);
// Route::post('categoria', [CategoriaController::class, 'store'])->middleware('can:categoria-create');
Route::post('categoria', [CategoriaController::class, 'store']);
Route::patch('categoria/{categoria}', [CategoriaController::class, 'update']);
Route::get('categoria', [CategoriaController::class, 'show']);
Route::delete('categoria/{categoria}', [CategoriaController::class, 'delete']);
Route::post('materia', [MateriaPrimaController::class, 'store']);
Route::patch('materia/{materia}', [MateriaPrimaController::class, 'update']);
Route::get('materia', [MateriaPrimaController::class, 'show']);
Route::delete('materia/{materia}', [MateriaPrimaController::class, 'delete']);
Route::get('produto_detalhe', [ProdutoDetalheController::class, 'index']);
Route::post('produto_detalhe', [ProdutoDetalheController::class, 'store']);
Route::delete('produto_detalhe/{produtoDetalhe}', [ProdutoDetalheController::class, 'destroy']);

Route::apiResource('imagens', ImagensController::class);

Route::middleware('auth:sanctum', 'ability:Profile-acess,App-manage')->group(function () {
  Route::apiResource('user_details', UserDetailsController::class);
});
  Route::apiResource('user_reviews', UserReviewsController::class);
  Route::get('user_favorites', [UserFavoritesController::class, 'index'])->name('favorites');
  Route::post('user_favorites', [UserFavoritesController::class, 'store'])->name('favorites.store');
  Route::delete('user_favorites/{id}', [UserFavoritesController::class, 'destroy'])->name('favorites.destroy');


Route::get('user', [UserController::class, 'index'])->name('users');
Route::resource('roles', RoleController::class);
