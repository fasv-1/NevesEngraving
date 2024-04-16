<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\profileController;

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
    return redirect('/home');
})->name('site');

Route::get('/mail', function () {
    return view('email.userMessage');
})->name('site');

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'] )->name('site.dashboard');
    Route::get('/dashboard/{any}', [DashboardController::class, 'index'])->where('any', '.*');
});



Route::get('/home', [HomeController::class, 'index'] )->name('site.home');

Route::get('/home/{any}',[HomeController::class, 'index'])->where('any', '.*');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cart', [CartController::class, 'showCart'] )->name('cart.show');
Route::post('/cart', [CartController::class, 'addtoCart'] )->name('cart.add');
Route::patch('/cart', [CartController::class, 'update'] )->name('cart.update');
Route::delete('/cart', [CartController::class, 'destroy'] )->name('cart.destroy');

Route::fallback(function(){
    echo 'Página não encontrada.<a href="'.route('site').'">Clique aqui</a>';
});

require __DIR__.'/auth.php';