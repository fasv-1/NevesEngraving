<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DescontoController;
use App\Http\Controllers\Custos_envio\EnvioPortugalController;
use App\Http\Controllers\Custos_envio\EnvioEuropaController;
use App\Http\Controllers\Custos_envio\EnvioOutrosController;
use App\Http\Controllers\Custos_envio\EnvioEuaController;
use App\Http\Controllers\ImagensController;
use App\Http\Controllers\ImagensProdutoController;
use App\Http\Controllers\OcasiaoController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UserReviewsController;
use App\Http\Controllers\UserFavoritesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaxaController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\TermoEcondicaoController;
use App\Http\Controllers\PedidoDetalheController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Controllers\MensagemController;
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


//---------------------- Discount Routes -----------------------------
Route::apiResource('desconto', DescontoController::class);
//-------------------------------------------------------------------- 

//---------------------- Images Routes ---------------------------------
Route::apiResource('imagens_produto', ImagensProdutoController::class);
Route::apiResource('imagens', ImagensController::class);
//-----------------------------------------------------------------------

//---------------------- Ocasion Routes -------------------------------------
Route::apiResource('ocasiao', OcasiaoController::class);
//----------------------------------------------------------------------------

//------------------------------ Category Routes --------------------------------------------------------
// Route::post('categoria', [CategoriaController::class, 'store'])->middleware('can:categoria-create');
Route::post('categoria', [CategoriaController::class, 'store']);
Route::patch('categoria/{categoria}', [CategoriaController::class, 'update']);
Route::get('categoria', [CategoriaController::class, 'show']);
Route::delete('categoria/{categoria}', [CategoriaController::class, 'delete']);

//--------------------------------- Material Routes ------------------------------------
Route::post('materia', [MateriaPrimaController::class, 'store']);
Route::patch('materia/{materia}', [MateriaPrimaController::class, 'update']);
Route::get('materia', [MateriaPrimaController::class, 'show']);
Route::delete('materia/{materia}', [MateriaPrimaController::class, 'delete']);

//------------------------------- Product Routes ---------------------------------
Route::apiResource('produto', ProdutoController::class);
Route::get('produto_detalhe', [ProdutoDetalheController::class, 'index']);
Route::post('produto_detalhe', [ProdutoDetalheController::class, 'store']);
Route::delete('produto_detalhe/{produtoDetalhe}', [ProdutoDetalheController::class, 'destroy']);
//-----------------------------------------------------------------------------------------------


//---------------------------------- User routes ------------------------------------ 
Route::middleware('auth:sanctum', 'ability:Profile-acess,App-manage')->group(function () {
  Route::apiResource('user_details', UserDetailsController::class);
});
Route::apiResource('user_reviews', UserReviewsController::class);
Route::get('user_favorites', [UserFavoritesController::class, 'index'])->name('favorites');
Route::post('user_favorites', [UserFavoritesController::class, 'store'])->name('favorites.store');
Route::delete('user_favorites/{id}', [UserFavoritesController::class, 'destroy'])->name('favorites.destroy');


Route::get('user', [UserController::class, 'index'])->name('users');
Route::patch('user/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
//-------------------------------------------------------------------------------------------

//------------------------------------ Roles route -------------------------------------------
Route::resource('roles', RoleController::class);

//---------------------------------shipping costs routes----------------------------------------
Route::get('shipping_portugal', [EnvioPortugalController::class, 'index'])->name('shipping_port');
Route::post('shipping_portugal', [EnvioPortugalController::class, 'store'])->name('shipping_port.store');
Route::delete('shipping_portugal/{id}', [EnvioPortugalController::class, 'destroy'])->name('shipping_port.destroy');

Route::get('shipping_europa', [EnvioEuropaController::class, 'index'])->name('shipping_euro');
Route::post('shipping_europa', [EnvioEuropaController::class, 'store'])->name('shipping_euro.store');
Route::delete('shipping_europa/{id}', [EnvioEuropaController::class, 'destroy'])->name('shipping_euro.destroy');

Route::get('shipping_eua', [EnvioEuaController::class, 'index'])->name('shipping_eua');
Route::post('shipping_eua', [EnvioEuaController::class, 'store'])->name('shipping_eua.store');
Route::delete('shipping_eua/{id}', [EnvioEuaController::class, 'destroy'])->name('shipping_eua.destroy');

Route::get('shipping_outros', [EnvioOutrosController::class, 'index'])->name('shipping_outros');
Route::post('shipping_outros', [EnvioOutrosController::class, 'store'])->name('shipping_outros.store');
Route::delete('shipping_outros/{id}', [EnvioOutrosController::class, 'destroy'])->name('shipping_outros.destroy');
//------------------------------------------------------------------------------------------

//---------------------------------taxes routes----------------------------------------
Route::apiResource('taxas', TaxaController::class);
//------------------------------------------------------------------------------------------

//---------------------------------content routes----------------------------------------
Route::apiResource('conteudo', ConteudoController::class);
//--------------------------------------------------------------------------------------------

//---------------------------------terms routes----------------------------------------
Route::apiResource('termos_condicoes', TermoEcondicaoController::class);
//----------------------------------------------------------------------------------------------

//---------------------------------order routes----------------------------------------
Route::apiResource('pedido_detalhe', PedidoDetalheController::class);
Route::apiResource('pedido_produto', PedidoProdutoController::class);
//----------------------------------------------------------------------------------------

//---------------------------------message routes----------------------------------------
Route::apiResource('mensagem', MensagemController::class);
//-----------------------------------------------------------------------------------------