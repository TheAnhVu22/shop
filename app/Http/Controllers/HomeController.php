<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\Social;
use Socialite;
use App\Models\Customer;
use Session;
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
    public function index()
    {
        return view('home');
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

    
}
