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
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryBlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VideoController;
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
Route::resource('cate_blog', CategoryBlogController::class)->middleware('auth');
Route::resource('cart', CartController::class);
Route::resource('customer', CustomerController::class);
Route::resource('coupon', CouponController::class);

// thư viện ảnh của sản phẩm
Route::resource('gallery', GalleryController::class)->middleware('auth');
Route::post('select_gallery',[GalleryController::class, 'select_gallery'])->name('select_gallery');
Route::post('insert_gallery/{pro_id}',[GalleryController::class, 'insert_gallery'])->name('insert_gallery');
Route::post('update_gallery_name',[GalleryController::class, 'update_gallery_name'])->name('update_gallery_name');
Route::post('delete_gallery',[GalleryController::class, 'delete_gallery'])->name('delete_gallery');
Route::post('update_gallery',[GalleryController::class, 'update_gallery'])->name('update_gallery');

// menu, trang chủ người dùng
Route::get('/danh_muc/{slug}',[IndexController::class, 'danhmuc'])->name('danh_muc');
Route::get('/thuong_hieu/{slug}',[IndexController::class, 'thuonghieu'])->name('thuong_hieu');
Route::get('/tin_tuc/{slug}',[IndexController::class, 'tintuc'])->name('tin_tuc');
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
Route::group(['middleware' => ['auth','role:Manager|admin']], function() {
	Route::get('/manage_order', [CheckoutController::class,'manage_order'])->name('manage_order');
	Route::get('/view_order_detail/{id}', [CheckoutController::class,'view_order_detail'])->name('view_order_detail');
	// cập nhật đơn hàng trong admin
	Route::post('/update-order-qty',[CheckoutController::class,'update_order_qty']);

	// xóa order và in hóa đơn PDF
	Route::get('/delete-order/{order_code}',[CheckoutController::class,'order_code']);
	Route::get('/print-order/{checkout_code}',[CheckoutController::class,'print_order']);

});  
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
Route::get('/tag/{tag}', [IndexController::class, 'tag']);

// mã giảm giá 
Route::post('/check-coupon',[CheckoutController::class,'check_coupon']);
Route::get('/unset_coupon',[CheckoutController::class,'unset_coupon']);

// quản lý phí Vận chuyển admin 
Route::get('/delivery',[DeliveryController::class,'delivery'])->name('delivery');
Route::post('/select-delivery',[DeliveryController::class,'select_delivery']);
Route::post('/insert-delivery',[DeliveryController::class,'insert_delivery']);
Route::post('/select-feeship',[DeliveryController::class,'select_feeship']);
Route::post('/update-delivery',[DeliveryController::class,'update_delivery']);

// chọn địa chỉ thanh toán
Route::post('/calculate-fee',[CheckoutController::class,'calculate_fee']);
Route::post('/select-delivery-home',[CheckoutController::class,'select_delivery_home']);
Route::post('/confirm-order',[CheckoutController::class,'confirm_order']);
Route::get('/del-fee',[CheckoutController::class,'del_fee']);


// nhập xuất dữ liệu ra file excel
Route::post('/export-category',[DeliveryController::class ,'export_category']);
Route::post('/import-category',[DeliveryController::class ,'import_category']);

// quản lý, phân quyền user
Route::group(['middleware' => ['auth','role:admin']], function() {
	Route::get('/manage_user', [UserController::class ,'index']);
	Route::delete('/delete_user/{id}', [UserController::class ,'delete_user']);

	Route::get('/assign_role/{id}', [UserController::class ,'assign_role']);
	Route::get('/assign_per/{id}', [UserController::class ,'assign_per']);

	Route::post('/them_vaitro',[UserController::class ,'them_vaitro']);
	Route::post('/phan_vaitro/{id}',[UserController::class ,'phan_vaitro']);
	Route::post('/them_quyen',[UserController::class ,'them_quyen']);
	Route::post('/phan_quyen/{id}',[UserController::class ,'phan_quyen']);
});  

// Video
Route::get('/video',[VideoController::class,'video']);
Route::post('/select_video',[VideoController::class,'select_video'])->name('select_video');
Route::post('/xoa_video',[VideoController::class,'xoa_video'])->name('xoa_video');
Route::post('/them_video',[VideoController::class,'them_video'])->name('them_video');
Route::post('/update_video',[VideoController::class,'update_video'])->name('update_video');

// comment ajax
Route::post('/loadcomment',[ProductController::class,'load_comment'])->name('loadcomment');
Route::post('/them_binhluan',[ProductController::class,'them_binhluan'])->name('them_binhluan');
Route::get('/binh_luan',[ProductController::class,'binh_luan']);
Route::post('/xoa_binhluan',[ProductController::class,'xoa_binhluan'])->name('xoa_binhluan');
Route::post('/traloi_binhluan',[ProductController::class,'traloi_binhluan'])->name('traloi_binhluan');

Route::post('/insert_rating',[ProductController::class,'insert_rating'])->name('insert_rating');