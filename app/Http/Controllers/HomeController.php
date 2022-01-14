<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\Social;
use Socialite;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Video;
use App\Models\Order;
use App\Models\Blog;
use App\Models\Statistical;
use App\Models\Coupon;
use Session;
use Carbon\Carbon;
use App\Models\Visitor;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {        
        //THong ke truy cap
        $user_ip_address = $request->ip();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateTimeString();
        
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateTimeString();
        $thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateTimeString();
        $motnam = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateTimeString();
        $now= Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();

        $visitor_thismonth= Visitor::whereBetween('created_at',[$thangnay,$now])->get();
        $visitor_thismonth_count= $visitor_thismonth->count();

        $visitor_lastmonth= Visitor::whereBetween('created_at',[$dauthangtruoc,$cuoithangtruoc])->get();
        $visitor_lastmonth_count= $visitor_lastmonth->count();

        $visitor_year= Visitor::whereBetween('created_at',[$motnam,$now])->get();
        $visitor_year_count= $visitor_year->count();

        $visitor_current= Visitor::where('ip_address',$user_ip_address)->get();
        $visitor_count= $visitor_current->count();

        if($visitor_count<1){
            $visitor = new Visitor();
            $visitor->ip_address= $user_ip_address;
            $visitor->save();
        }
        $visitors = Visitor::all();
        $visitor_total = $visitors->count();

         

        $product_view = Product::orderBy('product_views','DESC')->take(10)->get();
        $blog_view = Blog::orderBy('blog_views','DESC')->take(10)->get();
        return view('home',compact('user_ip_address','visitor_thismonth_count','visitor_lastmonth_count','visitor_year_count','visitor_count','visitor_total','product_view','blog_view'));
    }
    public function send_mail()
    {
         $to_name = "Anh the";
                $to_email = "theanhvu06@gmail.com";//send to this email
               
             
                $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
                
                Mail::send('pages.sendmail',$data,function($message) use ($to_name,$to_email){

                    $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });
    }
    public function send_coupon($id)
    {
        $coupon= Coupon::find($id);
        $customer = Customer::all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_email = "Mã khuyến mãi ngày ".$now;
        $data=[];
        foreach ($customer as $value) {
            $data['email'][] = $value->customer_email;
        }
        $ma= array(
            'start_date' =>$coupon->coupon_date_start,
            'end_date' =>$coupon->coupon_date_end,
            'quantity' =>$coupon->coupon_time,
            'condition' =>$coupon->coupon_condition,
            'number' =>$coupon->coupon_number,
            'code' =>$coupon->coupon_code,
        );
        Mail::send('pages.send_coupon',['ma'=>$ma],function($message) use ($title_email,$data){

                    $message->to($data['email'])->subject($title_email);//send this mail with subject
                    $message->from($data['email'],$title_email);//send from this mail
                });
        return redirect()->back()->with('message',"Gửi mã khuyến mãi thành công");
    }
    public function mail_example()
    {
        return view('pages.sendmail');
    }
    
    
}
