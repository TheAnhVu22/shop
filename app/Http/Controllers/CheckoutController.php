<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Blog;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Delivery;
use App\Models\CategoryBlog;
use Session;
use Cart;
use Hash;
use PDF;
use Laravel\Socialite\Facades\Socialite;


session_start();
class CheckoutController extends Controller
{
    // Giao diện đăng nhập
    public function login_checkout()
    {
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->take(10)->get();
        return view('pages.login',compact('category','brand','slide','cate_blog'));
    }
// Xử lý đăng xuất
    public function logout_checkout(){
        Session::forget('customer_id');
        return Redirect::to('/login_checkout');
    }
  // Lưu địa chỉ giao hàng
    public function save_checkout_customer(Request $request)
    {
        $data= $request->validate(
            [
                'shipping_email' => 'required',
                'shipping_name' => 'required',
                'shipping_phone' => 'required',
                'shipping_address' => 'required',
                'shipping_note' => 'required'
            ],
            [
               
            ]
            
        );
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->save();
        Session()->put('shipping_id', $shipping->id);
        return redirect(route('payment'));
    }
  // Trang chọn hình thức thanh toán  
    public function payment()
    {
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->take(10)->get();
        return view('pages.payment',compact('category','brand','slide','cate_blog'));
    }
 // Xử lý đăng nhập của khách hàng
    public function login_customer(Request $request)
    {
        $data = $request->all();
        $email = $data['login_email'];
        $mk =$data['login_password'];

        $customer = Customer::where('customer_email',$email)->first();
        if($customer!=NULL && password_verify($mk,$customer->customer_password)){
             Session()->put('customer_id', $customer->id);
            return redirect()->route('homepage');
        }
        else{
            return Redirect::to('/login_checkout')->with('status','tài khoản mật khẩu không đúng');
        }
    }

 //Xử lý lưu thông tin đơn đặt hàng vào DB
    public function order_place(Request $request)
    {
        // insert payment
        $data= $request->all();
        $payment = new Payment();
        $payment->payment_method = $data['payment-option'];
        $payment->payment_status = 'Đang chờ xử lý';
        $payment->save();

        // insert order
        $total = 0;
        foreach(Session::get('cart') as $key => $cart){
            $subtotal = $cart['product_price']*$cart['product_qty'];
            $total+=$subtotal;
        }
        $order = new Order();
        $order->customer_id = Session()->get('customer_id');
        $order->shipping_id = Session()->get('shipping_id');
        $order->payment_id = $payment->id;
        //$order->order_total = Cart::total();
        $order->order_total = $total;
        $order->order_status = 'Đang chờ xử lý';
        $order->save();


        // insert orderdetail
        // $content = Cart::content();
        // foreach ($content as $key) {
        //     $order_d = new OrderDetail();
        //     $order_d->order_id = $order->id;
        //     $order_d->product_id = $key->id;
        //     $order_d->product_content= $key->name;
        //     $order_d->product_price = $key->price;
        //     $order_d->product_sales_quantity = $key->qty;
        //     $order_d->save();
        // }
        foreach(Session::get('cart') as $key => $cart){
            $order_d = new OrderDetail();
            $order_d->order_id = $order->id;
            $order_d->product_id = $cart['product_id'];
            $order_d->product_content= $cart['product_name'];
            $order_d->product_price = $cart['product_price'];
            $order_d->product_sales_quantity = $cart['product_qty'];
            $order_d->save();
        }

        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->take(10)->get();
        //Cart::destroy();
        Session::forget('cart');
        Session::forget('coupon');
        return view('pages.order_success',compact('category','brand','slide'));
    }
    public function manage_order()
    {
        $order = Order::with('customer','shipping','orderdetail')->get();
        return view('admincp.ManageOrder.index',compact('order'));
    }
    public function view_order_detail($id)
    {   
        $order = Order::with('customer','shipping','orderdetail')->where('id',$id)->first();
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
        return view('admincp.ManageOrder.viewdetailorder',compact('order','orderdetail','coupon_condition','coupon_number'));
    }

   //google login
    public function redirectToGoogle()
    {
        config(['services.google.redirect' => 'http://shopanhthe.com/shop/public/logincheckout/google/callback']);
        return Socialite::driver('google')->redirect();
    }
    //google callback
    public function handleGoogleCallback()
    {
        config(['services.google.redirect' => 'http://shopanhthe.com/shop/public/logincheckout/google/callback']);
        $data = Socialite::driver('google')->stateless()->user();

        $user = Customer::where('customer_email',$data->email)->first();
        if(!$user){
            $user = new Customer();
            $user->customer_name = $data->name;
            $user->customer_email = $data->email;
            $user->provider_id = $data->id;
            $user->save(); 
        }
        Session()->put('customer_id', $user->id);
        Session()->put('customer_name', $user->customer_name);
        return redirect(route('homepage'));
    }

    //facebook login
    public function redirectToFacebook()
    {
        config(['services.facebook.redirect'=>env('FACEBOOK_CLIENT_URL')]);
        return Socialite::driver('facebook')->redirect();
    }
    //facebook callback
    public function handleFacebookCallback()
    {
        config(['services.facebook.redirect'=>env('FACEBOOK_CLIENT_URL')]);
        $data = Socialite::driver('facebook')->stateless()->user();
        $user = Customer::where('customer_email',$data->email)->first();
        if(!$user){
            $user = new Customer();
            $user->customer_name = $data->name;
            $user->customer_email = $data->email;
            $user->provider_id = $data->id;
            $user->save(); 
        }
        Session()->put('customer_id', $user->id);
        Session()->put('customer_name', $user->customer_name);
        return redirect(route('checkout'));
    }

    public function gio_hang(Request $request){
         $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->take(10)->get(); 

        return view('pages.cart_ajax',compact('slide','category','brand','cate_blog'));
    }
   public function add_cart_ajax(Request $request){
        // Session::forget('cart');
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }      
        Session::save();
    }
    public function delete_product($session_id){
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }

    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;

                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){

                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:blue">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thành công</p>';

                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        $message.='<p style="color:red">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thất bại</p>';
                    }

                }

            }

            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng thất bại');
        }
    }
    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }

    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }
    }

    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){         
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
    }
    // tính phí vận chuyển theo địa chỉ
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship1 = Delivery::where('thanhpho_id',$data['matp'])->where('quanhuyen_id',$data['maqh'])->where('xa_id',$data['xaid'])->get();
            if($feeship1){
                $count_feeship = $feeship1->count();
                // return $count_feeship; trả về 0 hoặc 1
                if($count_feeship>0){
                     foreach($feeship1 as $key => $fee){
                        Session::put('fee',$fee->feeship);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',31111);
                    Session::save();
                }
            }
           
        }
    }
    // xử lý chọn địa chỉ
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xa.'</option>';
                }
            }
            echo $output;
        }
    }

    public function confirm_order(Request $request){
         $data = $request->all();

         $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         $shipping->shipping_note = $data['shipping_note'];
         $shipping->shipping_method = $data['shipping_method'];
         $shipping->save();
         $shipping_id = $shipping->id;

         $checkout_code = substr(md5(microtime()),rand(0,26),6);

  
         $order = new Order();
         $order->customer_id = Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;
         $order->save();

         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetail();
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_content = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
         }
         Session::forget('coupon');
         Session::forget('fee');
         Session::forget('cart');
    }
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }

    public function update_order_qty(Request $request){
        //update order
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if($order->order_status=='2'){
            foreach($data['order_product_id'] as $key => $product_id){
                
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                        if($key==$key2){
                                $pro_remain = $product_quantity - $qty;
                                $product->product_quantity = $pro_remain;
                                $product->product_sold = $product_sold + $qty;
                                $product->save();
                        }
                }
            }
        }elseif($order->order_status!='2' && $order->order_status!='3'){
            foreach($data['order_product_id'] as $key => $product_id){
                
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                        if($key==$key2){
                                $pro_remain = $product_quantity + $qty;
                                $product->product_quantity = $pro_remain;
                                $product->product_sold = $product_sold - $qty;
                                $product->save();
                        }
                }
            }
        }


    }
    public function order_code(Request $request ,$order_code){
        $order = Order::where('order_code',$order_code)->first();
         
        $order_details = OrderDetail::where('order_code',$order_code)->get();
        foreach ($order_details as $key => $value) {
            $value->delete();
        }
        $order->delete();
         Session::put('message','Xóa đơn hàng thành công');
        return redirect()->back();

    }
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details = OrderDetail::where('order_code',$checkout_code)->get();
        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $date = $ord->created_at;
        }
        $customer = Customer::where('id',$customer_id)->first();
        $shipping = Shipping::where('id',$shipping_id)->first();

        $order_details_product = OrderDetail::with('product')->where('order_code', $checkout_code)->get();

        foreach($order_details_product as $key => $order_d){

            $product_coupon = $order_d->product_coupon;
        }
        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();

            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;

            if($coupon_condition==1){
                $coupon_echo = $coupon_number.'%';
            }elseif($coupon_condition==2){
                $coupon_echo = number_format($coupon_number,0,',','.').'đ';
            }
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;

            $coupon_echo = '0';
        
        }

        $output = '';

        $output.='<style>body{
            font-family: DejaVu Sans;
        }
        .table-styling{
            border:1px solid #000;
            width: 100%;
        }
        .table-styling tbody tr td{
            border:1px solid #000;
        }
        .table-styling thead tr th{
            border:1px solid #000;
        }
        </style>
        <div class="row">
        <div style="float:left">
        <img src="http://insongan.com.vn/wp-content/uploads/2020/05/in-h%C3%B3a-%C4%91%C6%A1n-%C4%91i%E1%BB%87n-tho%E1%BA%A1i.png" width="150" height ="150">
        </div>
        <div>
        <h2 style="text-align:center">Tập đoàn viễn thông ATV</h2>
        <h4><center>Hóa đơn mua hàng số: '.$checkout_code.'</center></h4>
        <h4><center>Ngày: '.date('d-m-Y', strtotime($date)).'</center></h4>
        </div>
</div>
        <p>Thông tin khách hàng:</p>
        <table class="table-styling table-bordered">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>';
                
        $output.='      
                    <tr>
                        <td>'.$customer->customer_name.'</td>
                        <td>'.$customer->customer_phone.'</td>
                        <td>'.$customer->customer_email.'</td>
                        
                    </tr>';
                

        $output.='              
                </tbody>
            
        </table>

        <p>Thông tin giao hàng:</p>
            <table class="table-styling">
                <thead>
                    <tr>
                        <th>Tên người nhận</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>';
                
        $output.='      
                    <tr>
                        <td>'.$shipping->shipping_name.'</td>
                        <td>'.$shipping->shipping_address.'</td>
                        <td>'.$shipping->shipping_phone.'</td>
                        <td>'.$shipping->shipping_email.'</td>
                        <td>'.$shipping->shipping_note.'</td>
                        
                    </tr>';
                

        $output.='              
                </tbody>
            
        </table>

        <p>Chi tiết đơn hàng:</p>
            <table class="table-styling">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Mã giảm giá</th>
                        
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>';
            
                $total = 0;

                foreach($order_details_product as $key => $product){

                    $subtotal = $product->product_price*$product->product_sales_quantity;
                    $total+=$subtotal;

                    if($product->product_coupon!='no'){
                        $product_coupon = $product->product_coupon;
                    }else{
                        $product_coupon = 'không mã';
                    }       

        $output.='      
                    <tr>
                        <td>'.$product->product_content.'</td>
                        <td>'.$product_coupon.'</td>
                        
                        <td>'.$product->product_sales_quantity.'</td>
                        <td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
                        <td>'.number_format($subtotal,0,',','.').'đ'.'</td>
                        
                    </tr>';
                }

                if($coupon_condition==1){
                    $total_after_coupon = ($total*$coupon_number)/100;
                    $total_coupon = $total - $total_after_coupon;
                }else{
                    $total_coupon = $total - $coupon_number;
                }

        $output.= '<tr>
                <td colspan="6">
                <div style="margin-left: 5px">
                    <p>Tổng tiền: '.number_format($total,0,',','.').'đ'.'</p>
                    <p>Mã giảm giá: '.$coupon_echo.'</p>
                    <p>Số tiền còn lại: '.number_format($total_coupon,0,',','.').'đ'.'</p>
                    <p>Phí ship: '.number_format($product->product_feeship,0,',','.').'đ'.'</p>
                    <p>Thanh toán : '.number_format($total_coupon + $product->product_feeship,0,',','.').'đ'.'</p>
                    </div>
                </td>
        </tr>';
        $output.='              
                </tbody>
            
        </table>

        
            <table>
                <thead>
                    <tr>
                        <th width="200px">Người lập phiếu</th>
                        <th width="750px">Người nhận</th>
                        
                    </tr>
                </thead>
                <tbody>';
                        
        $output.='              
                </tbody>
            
        </table>

        ';


        return $output;

    }
}
