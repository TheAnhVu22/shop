<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
class IndexController extends Controller
{
    public function index()
    {
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        $product = Product::with('category','brand')->where('product_status','1')->take(4)->get();
        $new_product = Product::where('product_status','1')->orderBy('id','DESC')->take(6)->get();
        return view('pages.home',compact('category','brand','product','new_product'));
    }
    public function danhmuc($slug)
    {
        
        return view('pages.');
    }
    public function thuonghieu($slug)
    {
        
        return view('pages.');
    }
    public function tintuc()
    {
        
        return view('pages.');
    }
    public function lienhe()
    {
        
        return view('pages.');
    }
    public function tabs_danhmuc(Request $request){
        $data = $request->all();
        
        $id = $data['danhmuc_id'];
        $category = CategoryProduct::find($id);
        
        $output ='';
       
        $nhiutruyen = [];
        foreach($category->product as $danh){
            $nhiutruyen[] = $danh->id;
        }

        $product = Product::with('category','brand')->orderBy('id','DESC')->where('product_status',1)->whereIn('id',$nhiutruyen)->paginate(12);
        foreach($product as $key => $value){
            $anh1 = 'uploads/'.$value->product_image;
            $gia = $value->product_price;
            $ten = $value->product_content;
            $output.='
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="'.$anh1.'" alt="" />
                            <h2>'.$gia.'</h2>
                            <p>'.$ten.'</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                        </div>
                        
                    </div>
                </div>
            </div>

            ';

        }
        echo $output;

    }
}
