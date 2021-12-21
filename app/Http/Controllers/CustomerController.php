<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Session;
use Hash;
use App\Rules\Captcha; 
use Validator;  
session_start();
class CustomerController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data= $request->validate(
            [
                'customer_email' => 'required|unique:customers',
                'customer_name' => 'required',
                'customer_phone' => 'required',
                'customer_password' => 'required',
                'g-recaptcha-response' => new Captcha(),
            ]
            
        );
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_password = Hash::make($data['customer_password']);
        $customer->save();
       Session()->put('customer_id', $customer->id);
        Session()->put('customer_name', $customer->customer_name);
        return redirect(route('checkout'));
    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
    }

    public function update(Request $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
