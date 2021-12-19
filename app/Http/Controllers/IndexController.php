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
class IndexController extends Controller
{
    public function index()
    {
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        $product = Product::with('category','brand')->where('product_status','1')->take(4)->get();
        $new_product = Product::where('product_status','1')->orderBy('id','DESC')->take(6)->get();
        return view('pages.home',compact('category','brand','product','new_product','slide'));
    }
    public function danhmuc($slug)
    {   
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $category_name = CategoryProduct::where('category_status','1')->where('category_slug',$slug)->first();
        $brand = BrandProduct::where('brand_status','1')->get();
        $product = Product::with('category','brand')->where('product_status','1')->where('category_id',$category_name->id)->paginate(12);
        return view('pages.category',compact('category','brand','product','category_name','slide'));
    }
    public function thuonghieu($slug)
    {
        $slide = Slide::all();
         $brand = BrandProduct::where('brand_status','1')->get();
        $brand_name = BrandProduct::where('brand_status','1')->where('brand_slug',$slug)->first();
        $category = CategoryProduct::where('category_status','1')->get();
        $product = Product::with('category','brand')->where('product_status','1')->where('brand_id',$brand_name->id)->paginate(12);
        return view('pages.brand',compact('category','brand','product','brand_name','slide'));
    }
    public function tintuc()
    {
        $blog = Blog::orderBy('id','DESC')->paginate(4);
        $slide = Slide::all();
         $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        return view('pages.about',compact('category','slide','brand','blog'));
    }
    public function lienhe()
    {
        $slide = Slide::all();
         $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        return view('pages.contact',compact('category','brand','slide'));
    }
    public function chitietsanpham($slug)
    {
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        $product = Product::with('category','brand')->where('product_slug',$slug)->first();
        $related_product = Product::where('category_id',$product->category_id)->whereNotIn('id',[$product->id])->take(6)->get();
        return view('pages.detailproduct',compact('category','brand','product','related_product','slide'));
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
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                        <a href="'.$url.'">
                            <img src="'.$anh1.'" alt="" />
                            <h2>'.$gia.'</h2>
                            <p>'.$ten.'</p>
                        </a>
                            
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
        $brand = BrandProduct::where('brand_status','1')->get();
        return view('pages.checkout',compact('category','brand','slide'));
    }
    public function view_blog($slug)
    {   $blog =Blog::where('blog_slug',$slug)->first();
        $slide = Slide::all();
         $category = CategoryProduct::where('category_status','1')->get();
        $brand = BrandProduct::where('brand_status','1')->get();
        return view('pages.blog',compact('category','brand','slide','blog'));
    }
}
