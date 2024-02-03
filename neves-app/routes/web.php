<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('site');

Route::get('/dashboard', [DashboardController::class, 'index'] )->name('site.dashboard');
Route::get('/home', [HomeController::class, 'index'] )->name('site.home');

Route::get('/home/{any}',[HomeController::class, 'index'])->where('any', '.*');

Route::get('/dashboard/{any}', function () {
    return view('dashboard');
})->where('any', '.*');

Route::fallback(function(){
    echo 'Página não encontrada.<a href="'.route('site').'">Clique aqui</a>';
});