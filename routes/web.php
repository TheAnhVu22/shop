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
use App\Http\Controllers\Auth\LoginController;
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
Route::resource('cart', CartController::class);
Route::resource('customer', CustomerController::class);

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
Route::post('/login_customer', [CheckoutController::class,'login_customer'])->name('login_customer');
Route::get('/checkout', [IndexController::class,'checkout'])->name('checkout');
// đăng xuất
Route::get('/logout_checkout',[CheckoutController::class, 'logout_checkout'])->name('logout_checkout');

// lưu địa chỉ giao hàng
Route::post('/save_checkout_customer', [CheckoutController::class,'save_checkout_customer'])->name('save_checkout_customer');
// chọn hình thức thanh toán
Route::get('/payment', [CheckoutController::class,'payment'])->name('payment');
// lưu đơn hàng
Route::post('/order_place', [CheckoutController::class,'order_place'])->name('order_place');

// quản lý đơn hàng
Route::get('/manage_order', [CheckoutController::class,'manage_order'])->name('manage_order');
Route::get('/view_order_detail/{id}', [CheckoutController::class,'view_order_detail'])->name('view_order_detail');

//send mail
Route::get('/send_mail', [HomeController::class,'send_mail'])->name('send_mail');

//face client login
Route::get('/login_checkout/facebook', [CheckoutController::class,'redirectToFacebook'])->name('login_checkout.facebook');
Route::get('/logincheckout/facebook/callback', [CheckoutController::class,'handleFacebookCallback']);

//google client login
Route::get('/login_checkout/google', [CheckoutController::class,'redirectToGoogle'])->name('login_checkout.google');
Route::get('/logincheckout/google/callback', [CheckoutController::class,'handleGoogleCallback']);


//face login
Route::get('/login/facebook', [LoginController::class,'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class,'handleFacebookCallback']);

//google login
Route::get('/login/google', [LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class,'handleGoogleCallback']);

//github login
Route::get('/login/github', [LoginController::class,'redirectToGithub'])->name('login.github');
Route::get('/login/github/callback', [LoginController::class,'handleGithubCallback']);

// Thêm đơn hàng vào giỏ bằng ajax
Route::post('/add_cart_ajax',[CheckoutController::class,'add_cart_ajax'])->name('add_cart_ajax');
// hiển thị giỏ hàng ajax
Route::get('/gio_hang',[CheckoutController::class,'gio_hang'])->name('gio_hang');
// cập nhật giỏ hàng ajax
Route::post('/update-cart',[CheckoutController::class,'update_cart']);
//xóa giỏ hàng bằng ajax
Route::get('/del-product/{session_id}',[CheckoutController::class,'delete_product']);
Route::get('/del-all-product',[CheckoutController::class,'delete_all_product']);

//tìm kiếm ajax
Route::post('/tim_kiem', [IndexController::class,'timkiem']);
Route::post('/autocomplete-ajax',[IndexController::class,'autocomplete_ajax']);
