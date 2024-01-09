<?php

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
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/dashboard/{any}', function () {
    return view('dashboard');
})->where('any', '.*');

Route::fallback(function(){
    echo 'Página não encontrada.<a href="'.route('index').'">Clique aqui</a>';
});