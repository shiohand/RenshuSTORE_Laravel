<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* テスト用 */
// Route::get('/test', [CartController::class, 'test']);
/* -------- */

Route::get('/', MainController::class)
    ->name('top');

Route::get('/ranking', RankingController::class)
    ->name('ranking');
Route::get('/products', ProductsController::class)
    ->name('products');

Route::get('/product/{id}', [ProductController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('product');
Route::get('/product/{id}/review', [ProductController::class, 'review'])
    ->where('id', '[0-9]+')
    ->name('product.review');

Route::post('/review/confirm', [ReviewController::class, 'confirm'])
    ->middleware('auth')
    ->name('review.confirm');
Route::get('/review/confirm', [ReviewController::class, 'confirm_get'])
    ->middleware('auth')
    ->name('review.confirm_get');
Route::post('/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('review.store');

Route::get('/cart', [CartController::class, 'show'])
    ->name('cart');
Route::post('/cart', [CartController::class, 'update'])
    ->name('cart.update');
Route::post('/cart/in', [CartController::class, 'store'])
    ->name('cart.in');
Route::get('/cart/in', [CartController::class, 'store_get'])
    ->name('cart.in_get');
Route::post('/cart/clear', [CartController::class, 'destroy'])
    ->name('cart.clear');

Route::get('/order', [OrderController::class, 'create'])
    ->middleware('order')
    ->name('order');
Route::get('/order/member', [OrderController::class, 'create_member'])
    ->middleware('auth')
    ->middleware('order')
    ->name('order.member');
Route::post('/order/confirm', [OrderController::class, 'confirm'])
    ->middleware('order')
    ->name('order.confirm');
Route::get('/order/confirm', [OrderController::class, 'confirm_get'])
    ->middleware('order')
    ->name('order.confirm_get');
Route::post('/order', [OrderController::class, 'store'])
    ->name('order.store');
Route::post('/order/member', [OrderController::class, 'store_member'])
    ->name('order.store.member');

Route::get('/user', [UserController::class, 'show'])
    ->middleware('auth')
    ->name('user');
Route::get('/user/reviewed', [UserController::class, 'reviewed'])
    ->middleware('auth')
    ->name('user.reviewed');
Route::get('/user/ordered', [UserController::class, 'ordered'])
    ->middleware('auth')
    ->name('user.ordered');
Route::get('/user/edit', [UserController::class, 'edit'])
    ->middleware('auth')
    ->name('user.edit');
Route::put('/user', [UserController::class, 'update'])
    ->middleware('auth')
    ->name('user.update');
Route::get('/user/delete/confirm', [UserController::class, 'delete_confirm'])
    ->middleware('auth')
    ->name('user.delete.confirm');
Route::delete('/user', [UserController::class, 'destroy'])
    ->middleware('auth')
    ->name('user.destroy');

Route::any('/error', ErrorController::class)
    ->name('error');

require __DIR__.'/auth.php';
