<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [IndexController::class , 'index'])->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('category', CategoryProductController::class);
Route::resource('brand', BrandProductController::class);
Route::resource('product', ProductController::class);

Route::get('/danh_muc/{slug}',[IndexController::class, 'danhmuc'])->name('danh_muc');
Route::get('/thuong_hieu/{slug}',[IndexController::class, 'thuonghieu'])->name('thuong_hieu');
Route::get('/tin_tuc',[IndexController::class, 'tintuc'])->name('tin_tuc');
Route::get('/lien_he',[IndexController::class, 'lienhe'])->name('lien_he');

Route::post('/tabs_danhmuc', [IndexController::class,'tabs_danhmuc'])->name('tabs_danhmuc');
