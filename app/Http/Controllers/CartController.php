<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Blog;
use Session;
use Cart;

session_start();
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        Cart::setGlobalTax(0);
        // Cart::destroy();
        return view('pages.cart',compact('slide','category','brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request->pro_id_hide;
        $quantity = $request->soluong;
        $product_info = Product::find($product_id);
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        $data['id']= $product_info->id;
        $data['qty']= $quantity;
        $data['name']= $product_info->product_content;
        $data['price']= $product_info->product_price;
        $data['weight']= '1';
        $data['options']['image']= $product_info->product_image;
        Cart::add($data);
        return redirect()->back()->with('status','Thêm vào giỏ hàng thành công');
    }

    
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
