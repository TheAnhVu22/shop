<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
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
// trang chủ shop
Route::get('/', [IndexController::class , 'index'])->name('homepage');

//trang chủ admin
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('category', CategoryProductController::class)->middleware('auth');
Route::resource('brand', BrandProductController::class)->middleware('auth');
Route::resource('product', ProductController::class)->middleware('auth');
Route::resource('blog', BlogController::class)->middleware('auth');
Route::resource('slide', SlideController::class)->middleware('auth');
Route::resource('cart', CartController::class)->middleware('auth');
Route::resource('customer', CustomerController::class)->middleware('auth');

Route::get('/danh_muc/{slug}',[IndexController::class, 'danhmuc'])->name('danh_muc');
Route::get('/thuong_hieu/{slug}',[IndexController::class, 'thuonghieu'])->name('thuong_hieu');
Route::get('/tin_tuc',[IndexController::class, 'tintuc'])->name('tin_tuc');
Route::get('/lien_he',[IndexController::class, 'lienhe'])->name('lien_he');

Route::get('/chi_tiet_san_pham/{slug}',[IndexController::class, 'chitietsanpham'])->name('chi_tiet_san_pham');
Route::get('/view_blog/{slug}', [IndexController::class,'view_blog'])->name('view_blog');
Route::post('/tabs_danhmuc', [IndexController::class,'tabs_danhmuc'])->name('tabs_danhmuc');

// sửa xóa đơn hàng
Route::post('/update_cart', [IndexController::class,'updatecart'])->name('update_cart');
Route::get('/cart_delete/{rowId}', [IndexController::class,'cart_delete'])->name('cart_delete');

// đăng nhập thanh toán
Route::get('/login_checkout',[CheckoutController::class, 'login_checkout'])->name('login_checkout');
Route::get('/checkout', [IndexController::class,'checkout'])->name('checkout');

