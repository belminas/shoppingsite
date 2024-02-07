<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [App\Http\Controllers\PostsController::class, 'index']);

Route::get('/products/create', [App\Http\Controllers\PostsController::class, 'create']);

Route::post('/products', [App\Http\Controllers\PostsController::class, 'store']);

Route::get('/search', [App\Http\Controllers\PostsController::class, 'search']);

Route::get('/products/{post}', [App\Http\Controllers\PostsController::class, 'show']);

Route::delete('/delete/{post}',[App\Http\Controllers\PostsController::class, 'delete'])->middleware('auth');

Route::get('/cart',[App\Http\Controllers\CartController::class, 'index']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add/{postId}', [CartController::class, 'store'])->name('cart.store');

Route::get('/profile', [App\Http\Controllers\ProfilesController::class, 'show'])->name('profile.index');

Route::get('/cart/remove/{postId}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/confirm-purchase', [CartController::class, 'confirmPurchase'])->name('cart.confirmPurchase');