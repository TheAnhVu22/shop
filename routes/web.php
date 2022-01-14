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
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\IconController;

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
Route::get('lang/{lan}', function($lan){
	if(in_array($lan, ['vi','en'])){
		Session::put('lan', $lan);
		return redirect()->back();
	}
});

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

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
//quên mật khẩu
Route::get('/quen_mk',[CheckoutController::class, 'quen_mk']);
Route::post('/lay_mk',[CheckoutController::class, 'lay_mk']);
Route::get('/update_pass',[CheckoutController::class, 'update_pass']);
Route::post('/update_new_pass',[CheckoutController::class, 'update_new_pass']);
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
Route::get('/send_coupon/{id}', [HomeController::class,'send_coupon'])->name('send_coupon');
Route::get('/mail_example', [HomeController::class,'mail_example'])->name('mail_example');

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
Route::get('/unset-coupon',[CheckoutController::class,'unset_coupon']);

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

// đánh giá sao
Route::post('/insert_rating',[ProductController::class,'insert_rating'])->name('insert_rating');

//xắp xếp danh mục kéo thả bằng ajax
Route::post('resorting', [CategoryProductController::class,'resorting'])->name('resorting');

//sản phẩm yêu thích
Route::get('/yeuthich', [IndexController::class, 'yeuthich'])->name('yeuthich');

//Thống kê
Route::post('/filter-by-date', [StatisticalController::class, 'filter_by_date']);
Route::post('/days-order', [StatisticalController::class, 'days_order']);
Route::post('/dashboard-filter', [StatisticalController::class, 'dashboard_filter']);

//Document gg drive
Route::get('upload_file', [DocumentController::class, 'upload_file'])->name('upload_file');
Route::get('upload_image', [DocumentController::class, 'upload_image'])->name('upload_image');
Route::get('upload_video', [DocumentController::class, 'upload_video'])->name('upload_video');

Route::get('download_document/{path}/{name}', [DocumentController::class, 'download_document'])->name('download_document');
Route::get('create_document', [DocumentController::class, 'create_document'])->name('create_document');
Route::get('list_document', [DocumentController::class, 'list_document'])->name('list_document');
Route::get('read_document', [DocumentController::class, 'read_document'])->name('read_document');
Route::get('delete_document/{path}', [DocumentController::class, 'delete_document'])->name('delete_document');

//Folder
Route::get('create_folder', [DocumentController::class, 'create_folder'])->name('create_folder');
Route::get('rename_folder', [DocumentController::class, 'rename_folder'])->name('rename_folder');
Route::get('delete_folder', [DocumentController::class, 'delete_folder'])->name('delete_folder');
Route::get('read_data', [DocumentController::class, 'read_data'])->name('read_data');

//lịch sử đơn hàng
Route::get('taikhoan', [IndexController::class, 'taikhoan'])->name('taikhoan');
Route::get('history_detail/{code}', [IndexController::class, 'history_detail'])->name('history_detail');

Route::get('/generate-qrcode', [QrCodeController::class, 'index']);

//Nhà tài trợ
Route::get('/nhataitro', [VideoController::class, 'nhataitro']);
Route::post('/select_ntt', [VideoController::class, 'select_ntt'])->name('select_ntt');
Route::post('/add_ntt', [VideoController::class, 'add_ntt'])->name('add_ntt');
Route::post('/delete_ntt', [VideoController::class, 'delete_ntt'])->name('delete_ntt');
Route::post('/edit_ntt', [VideoController::class, 'edit_ntt'])->name('edit_ntt');
Route::post('/update_ntt', [VideoController::class, 'update_ntt'])->name('update_ntt');

Route::get('/icon', [IconController::class, 'icon']);
Route::post('/select_icon', [IconController::class, 'select_icon']);
Route::post('/add_icon', [IconController::class, 'add_icon']);
Route::post('/delete_icon', [IconController::class, 'delete_icon']);
Route::post('/edit_icon', [IconController::class, 'edit_icon']);
Route::post('/edit_img', [IconController::class, 'edit_img']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/file-browser', [ProductController::class, 'file_browser']);
Route::post('/uploads-ckeditor', [ProductController::class, 'uploads_ckeditor']);

Route::get('/count_cart', [IndexController::class, 'count_cart']);
Route::get('/giohang_hover', [IndexController::class, 'giohang_hover']);
Route::get('/load_more', [IndexController::class, 'load_more']);
Route::get('/show_quick_cart', [IndexController::class, 'show_quick_cart']);
Route::post('/delete_quick_cart', [IndexController::class, 'delete_quick_cart']);