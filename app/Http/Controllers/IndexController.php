<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Blog;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\City;
use App\Models\CategoryBlog;
use App\Models\Gallery;
use App\Models\Rating;
use Carbon\Carbon;
use Session;
use Cart;
session_start();
class IndexController extends Controller
{
    public function index(Request $request)
    {
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện ,điện thoại, máy tính"; 
        $meta_keywords = "thiet bi game,phu kien game,game phu kien,game giai tri, dien thoai, may tinh";
        $meta_title = "Phụ kiện, điện thoại, máy tính chính hãng";
        $url_canonical = \URL::current();
        $image_og = url('public/img/logos/visa.png');
        $link_icon = url('public/img/logos/visa.png');
        //--seo
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $product = Product::with('category','brand')->where('product_status','1')->orderBy('product_views','DESC')->take(6)->get();
        $new_product = Product::where('product_status','1')->orderBy('id','DESC')->paginate(9);
        return view('pages.home',compact('category','cate_blog','brand','product','new_product','slide','meta_desc','meta_keywords','meta_title','url_canonical','image_og','cate_blog'));
    }
    public function danhmuc($slug)
    {   
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $category_name = CategoryProduct::where('category_status','1')->where('category_slug',$slug)->first();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            // ->appends(request()->query()) phân trang vẫn giữ được url, hay kiểu xắp xếp

            if($sort_by=='tang_dan'){
                $product = Product::with('category','brand')->where('product_status','1')->where('category_id',$category_name->id)->orderBy('product_price','ASC')->paginate(12)->appends(request()->query());
            }elseif ($sort_by=='giam_dan') {
                $product = Product::with('category','brand')->where('product_status','1')->where('category_id',$category_name->id)->orderBy('product_price','DESC')->paginate(12)->appends(request()->query());

            }
            elseif ($sort_by=='kytu_az') {
                $product = Product::with('category','brand')->where('product_status','1')->where('category_id',$category_name->id)->orderBy('product_content','ASC')->paginate(12)->appends(request()->query());

            }elseif($sort_by=='kytu_za'){
                $product = Product::with('category','brand')->where('product_status','1')->where('category_id',$category_name->id)->orderBy('product_content','DESC')->paginate(12)->appends(request()->query());

            }
        }
        elseif(isset($_GET['start_price']) && isset($_GET['end_price'])){
            $min=$_GET['start_price'];
            $max=$_GET['end_price'];
            $product = Product::with('category','brand')->whereBetween('product_price',[$min,$max])->where('product_status','1')->where('category_id',$category_name->id)->paginate(12);
        }
        else{
            $product = Product::with('category','brand')->where('product_status','1')->where('category_id',$category_name->id)->paginate(12);
        }
        
        return view('pages.category',compact('category','brand','product','category_name','slide','cate_blog'));
    }
    public function thuonghieu($slug)
    {
        $slide = Slide::all();
         $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $brand_name = BrandProduct::with('product')->where('brand_status','1')->where('brand_slug',$slug)->first();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $category = CategoryProduct::where('category_status','1')->get();
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            // ->appends(request()->query()) phân trang vẫn giữ được url, hay kiểu xắp xếp

            if($sort_by=='tang_dan'){
                $product = Product::with('category','brand')->where('product_status','1')->where('brand_id',$brand_name->id)->orderBy('product_price','ASC')->paginate(12)->appends(request()->query());
            }elseif ($sort_by=='giam_dan') {
                $product = Product::with('category','brand')->where('product_status','1')->where('brand_id',$brand_name->id)->orderBy('product_price','DESC')->paginate(12)->appends(request()->query());

            }
            elseif ($sort_by=='kytu_az') {
                $product = Product::with('category','brand')->where('product_status','1')->where('brand_id',$brand_name->id)->orderBy('product_content','ASC')->paginate(12)->appends(request()->query());

            }elseif($sort_by=='kytu_za'){
                $product = Product::with('category','brand')->where('product_status','1')->where('brand_id',$brand_name->id)->orderBy('product_content','DESC')->paginate(12)->appends(request()->query());

            }
        }
        elseif(isset($_GET['start_price']) && isset($_GET['end_price'])){
            $min=$_GET['start_price'];
            $max=$_GET['end_price'];
            $product = Product::with('category','brand')->whereBetween('product_price',[$min,$max])->where('product_status','1')->where('brand_id',$brand_name->id)->paginate(12);
        }
        else{
        $product = Product::with('category','brand')->where('product_status','1')->where('brand_id',$brand_name->id)->paginate(12);
        }   
        return view('pages.brand',compact('category','brand','product','brand_name','slide','cate_blog'));
    }
    public function tintuc($slug)
    {       
        $cate_name = CategoryBlog::where('cate_blog_slug',$slug)->first();
        $blog = Blog::where('cate_blog_id',$cate_name->id)->orderBy('id','DESC')->paginate(6);
        $slide = Slide::all();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
         $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        return view('pages.about',compact('category','slide','brand','blog','cate_blog','cate_name'));
    }
    public function lienhe()
    {
        $slide = Slide::all();
         $category = CategoryProduct::where('category_status','1')->get();
         $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        
        return view('pages.contact',compact('category','brand','slide','cate_blog'));
    }
    public function chitietsanpham($slug)
    {
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện ,điện thoại, máy tính"; 
        $meta_keywords = "thiet bi game,phu kien game,game phu kien,game giai tri, dien thoai, may tinh";
        $meta_title = "Phụ kiện, điện thoại, máy tính chính hãng";
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $url_canonical = \URL::current();
        $image_og = url('public/img/logos/visa.png');
        $link_icon = url('public/img/logos/visa.png');
        //--seo

        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $product = Product::with('category','brand')->where('product_slug',$slug)->first();
        $gallery = Gallery::where('product_id',$product->id)->get();
        $related_product = Product::where('category_id',$product->category_id)->whereNotIn('id',[$product->id])->get();
        $rating = Rating::where('product_id',$product->id)->avg('rating');
        $rating1=round($rating,1);
        $rating=round($rating);

        $product->product_views= $product->product_views+1;
        $product->save();

        
        
        return view('pages.detailproduct',compact('cate_blog','category','brand','product','related_product','slide','meta_desc','meta_keywords','meta_title','url_canonical','image_og','link_icon','gallery','rating','rating1'));
    }
    
    public function tabs_danhmuc(Request $request){
        $data = $request->all();
        
        $id = $data['danhmuc_id'];
        $category = CategoryProduct::find($id);        
        $output ='';
        $product = Product::with('category','brand')->orderBy('id','DESC')->where('product_status',1)->where('category_id',$category->id)->paginate(3);

        foreach($product as $key => $value){
            $anh1 = 'uploads/'.$value->product_image;
            $gia = number_format($value->product_price);
            $ten = $value->product_content;
            $url=  route('chi_tiet_san_pham',$value->product_slug);
            $output.='
            <input type="hidden" value="'.$value->id.'" class="cart_product_id_'.$value->id.'">
            <input type="hidden" value="'.$value->product_content.'" class="cart_product_name_'.$value->id.'">
          
            <input type="hidden" value="'.$value->product_quantity.'" class="cart_product_quantity_'.$value->id.'">
            
            <input type="hidden" value="'.$value->product_image.'" class="cart_product_image_'.$value->id.'">
            <input type="hidden" value="'.$value->product_price.'" class="cart_product_price_'.$value->id.'">
            <input type="hidden" value="1" class="cart_product_qty_'.$value->id.'">

            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                        <a href="'.$url.'">
                            <img src="'.$anh1.'" alt="" />
                            <h2 style="color:orange;">'.$gia.' VNĐ</h2>
                            <p>'.$ten.'</p>
                        </a>
                        <button class="btn btn-success" id="'.$value->id.'" onclick="Addtocart(this.id)">Thêm vào giỏ hàng</button>
                        </div>
                        
                    </div>
                </div>
            </div>

            ';
        }
        echo $output;
    }
    public function updatecart(Request $request)
    {
        $rowId = $request->cart_rowId;
        $sl = $request->cart_quantity;
        Cart::update($rowId,$sl);
        return redirect()->back()->with('status','Cập nhật thành công');
    }
    public function cart_delete($rowId)
    {
        Cart::update($rowId,0);
        return redirect()->back()->with('status','Xóa khỏi giỏ hàng thành công');
    }
    public function checkout()
    {
        $slide = Slide::all();
         $category = CategoryProduct::where('category_status','1')->get();
         $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $city = City::orderby('matp','ASC')->get();
        return view('pages.checkout',compact('category','brand','slide','city','cate_blog'));
    }
    public function view_blog($slug)
    {   $blog =Blog::with('categoryblog')->where('blog_slug',$slug)->first();
        $slide = Slide::all();
         $category = CategoryProduct::where('category_status','1')->get();
         $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $blog->blog_views= $blog->blog_views+1;
        $blog->save();
        return view('pages.blog',compact('category','brand','slide','blog','cate_blog'));
    }
    public function timkiem(Request $request)
    {   $data = $request->all();
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
         
        $tag = $data['tukhoa'];    
        $product = Product::with('category','brand')->where('product_content','LIKE','%'.$tag.'%')->orWhere('product_desc','LIKE','%'.$tag.'%')->paginate(12);
            
        return view('pages.timkiem',compact('slide','category','brand','product','tag','cate_blog'));
        
    }
    public function autocomplete_ajax(Request $request){
        $data = $request->all();

        if($data['query']){

            $product = Product::where('product_content','LIKE','%'.$data['query'].'%')->get();

            $output = '
            <ul class="dropdown-menu" style="display:block;">'
            ;

            foreach($product as $key => $tr){
             $output .= '
             <li class="li_search_ajax"><a href="#">'.$tr->product_content.'</a></li>
             ';
         }

         $output .= '</ul>';
         echo $output;
     }
    }
    public function tag($tag)
    {
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();

        $tags = explode("-",$tag);
        $product = Product::with('brand','category')->where(
            function ($query) use($tags) {
            for ($i = 0; $i < count($tags); $i++){
                $query->orwhere('product_tags', 'like',  '%' . $tags[$i] .'%');
            }
            })->paginate(12);

        return view('pages.tag')->with(compact('slide','category','brand','cate_blog','tag','product'));
        
    }
    public function yeuthich()
    {
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        return view('pages.danhsachyeuthich')->with(compact('slide','category','brand','cate_blog'));
    }
    public function taikhoan()
    {
        if(!Session::get('customer_id')){
            return redirect('login_checkout');
        }else{
         $slide = Slide::all();
         $category = CategoryProduct::where('category_status','1')->get();
         $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $customer = Customer::find(Session::get('customer_id'));

        $order = Order::with('customer','shipping','orderdetail')->where('customer_id',$customer->id)->get();
        
        return view('pages.history',compact('category','brand','slide','cate_blog','customer','order'));
        }
    }
    public function history_detail($code)
    {
        $slide = Slide::all();
         $category = CategoryProduct::where('category_status','1')->get();
         $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $customer = Customer::find(Session::get('customer_id'));
        $order = Order::with('customer','shipping','orderdetail')->where('order_code',$code)->first();
        $orderdetail = OrderDetail::with('product','coupon')->where('order_code',$order->order_code)->get();
        foreach($orderdetail as $key => $order_d){

            $product_coupon = $order_d->product_coupon;
        }
        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        return view('pages.history_detail',compact('category','brand','slide','cate_blog','customer','order','orderdetail','coupon_condition','coupon_number'));
    }
    public function count_cart()
    {   
        $cart = count(Session::get('cart'));
        $output='';
        if($cart>0){
            $output.='<a href="'.route('gio_hang').'"><i class="fa fa-shopping-cart"></i>Giỏ hàng<span class="badge" style="background-color:red">'.$cart.'</span></a>';
        }else{
            $output.='<a href="'.route('gio_hang').'"><i class="fa fa-shopping-cart"></i>Giỏ hàng<span class="badge">0</span></a>';
        }
        echo $output;
    }
    public function giohang_hover()
    {
        //{{ chon-mua-dong-ho-cho-nguoi-lon-tuoi-nhung-dieu-can-luu-y-1-800x4500.jpg') }}
        $cart = count(Session::get('cart'));
        $output='';
        if($cart>0){
            $output.='<ul class="hover-cart">';
            foreach (Session::get('cart') as $key=> $value) {
                $output.='
                        <li><a href="'.route('gio_hang').'">
                            <img src="'.asset('uploads/'.$value['product_image']).'" alt="" width="100%" height="80">
                            <p>Tên: '.$value['product_name'].'</p>
                            <p>Giá:'.number_format($value['product_price']).'</p>
                            <p>Số lượng: '.number_format($value['product_qty']).'</p>
                        </a></li>
                       ';
            }
            $output.='</ul>';
        }else{
             $output.='<ul class="hover-cart">
                        <li><p>Chưa có sản phẩm</p></li></ul>';
        }
        echo $output;
    }
    public function show_quick_cart()
    {
        $output='<thead>
                        <tr class="cart_menu">
                           <th class="image text-center">Hình ảnh</th>
                           <th class="description text-center">Tên sản phẩm</th>
                           <th class="description text-center">Số lượng tồn</th>
                           <th class="price text-center">Giá sản phẩm</th>
                           <th class="quantity text-center">Số lượng</th>
                           <th class="total text-center">Thành tiền</th>
                           <th class="text-center"></th>
                        </tr>
                     </thead>
                     <tbody>';

                if(Session::get('cart')==true){
                    
                    $total = 0;
                    
                    foreach(Session::get('cart') as $key => $cart){
                    
                    $subtotal = $cart['product_price']*$cart['product_qty'];
                    $total+=$subtotal;
                    
                     $output.='<tr>
                           <td class="cart_product">
                              <img src="'.asset('uploads/'.$cart['product_image']).'" width="90" alt="'.$cart['product_name'].'" />
                           </td>
                           <td class="cart_description">
                              <p>'.$cart["product_name"].'</p>
                           </td>
                           <td class="cart_description text-center">
                              <p>'.$cart['product_quantity'].'</p>
                           </td>
                           <td class="cart_price text-center">
                              <p>'.number_format($cart['product_price'],0,',','.').'đ</p>
                           </td>
                           <td class="cart_quantity text-center">
                              <div class="cart_quantity_button">
                                 <input class="cart_quantity" type="number" min="1" name="cart_qty['.$cart['session_id'].']" value="'.$cart['product_qty'].'"  >
                              </div>
                           </td>
                           <td class="cart_total text-center">
                              <p class="cart_total_price">
                                 '.number_format($subtotal,0,',','.').'đ
                              </p>
                           </td>
                           <td class="cart_delete text-center">
                              <button type="button" class="cart_quantity_delete btn btn-danger" onclick="delete_cart_product('.$cart['product_id'].')"><i class="fa fa-times"></i></button>
                           </td>
                        </tr>';
                        }
                         $output.='<tr>
                           <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm" style="background-color: #AEF809; color: black;"></td>
                           <td><a class="btn btn-default check_out" href="'.url('/del-all-product').'" style="background-color:#F82E09">Xóa tất cả</a></td>
                           
                           <td>';
                            
                              $customer_id = Session()->get('customer_id');
                              $shipping_id = Session()->get('shipping_id');
                            
                            if($customer_id == null){
                               $output.='<a class="btn btn-default check_out" href="'.route('login_checkout').'" style="background-color:#17F809; color:black;">Thanh toán</a>';
                              
                              }else{
                               $output.='<a class="btn btn-default check_out" href="'.route('checkout').'" style="background-color:#17F809; color: black;"> Thanh toán</a>';
                              }
                            $output.='</td>
                           <td colspan="2">
                              <li>Tổng tiền :<span>'.number_format($total,0,',','.').'đ</span></li>
                              
                           </td>
                        </tr>';
                        }else{ 
                        $output.='<tr>
                           <td colspan="5">
                              <center>
                                 <p>Làm ơn thêm sản phẩm vào giỏ hàng
                                 </p>
                              </center>
                           </td>
                        </tr>';
                        }
                     $output.='</tbody>';
                     echo $output;
    }
    public function delete_quick_cart(Request $request)
    {

        $data = $request->all();

        $cart = Session::get('cart');

        if($cart==true){
            foreach($cart as $key => $val){
                if($val['product_id']==$data['id']){

                    unset($cart[$key]);
                    
                }
            }
            Session::put('cart',$cart);

        }
    }
}
