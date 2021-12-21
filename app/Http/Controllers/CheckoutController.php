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
use Session;
use Cart;
use Hash;
use Laravel\Socialite\Facades\Socialite;


session_start();
class CheckoutController extends Controller
{
    // Giao diện đăng nhập
    public function login_checkout()
    {
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        return view('pages.login',compact('category','brand','slide'));
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
        $brand = BrandProduct::where('brand_status','1')->get();
        return view('pages.payment',compact('category','brand','slide'));
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
            return redirect(route('checkout'));
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
        $brand = BrandProduct::where('brand_status','1')->get();
        //Cart::destroy();
        Session::forget('cart');
        Session::forget('coupon');
        return view('pages.order_success',compact('category','brand','slide'));
    }
    public function manage_order()
    {
        $order = Order::with('customer','shipping','payment','orderdetail')->get();
        return view('admincp.ManageOrder.index',compact('order'));
    }
    public function view_order_detail($id)
    {
        $order = Order::with('customer','shipping','payment','orderdetail')->find($id);
        $orderdetail = OrderDetail::with('product')->where('order_id',$order->id)->get();
        return view('admincp.ManageOrder.viewdetailorder',compact('order','orderdetail'));
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
        return redirect(route('checkout'));
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
        $brand = BrandProduct::where('brand_status','1')->get(); 

        return view('pages.cart_ajax',compact('slide','category','brand'));
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

}
