<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Blog;
use App\Models\City;
use App\Models\CategoryBlog;
use App\Models\Gallery;
use App\Models\Rating;
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
        $product = Product::with('category','brand')->where('product_status','1')->take(3)->get();
        $new_product = Product::where('product_status','1')->orderBy('id','DESC')->take(6)->get();
        return view('pages.home',compact('category','cate_blog','brand','product','new_product','slide','meta_desc','meta_keywords','meta_title','url_canonical','image_og','cate_blog'));
    }
    public function danhmuc($slug)
    {   
        $slide = Slide::all();
        $category = CategoryProduct::where('category_status','1')->get();
        $category_name = CategoryProduct::where('category_status','1')->where('category_slug',$slug)->first();
        $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $product = Product::with('category','brand')->where('product_status','1')->where('category_id',$category_name->id)->paginate(12);
        return view('pages.category',compact('category','brand','product','category_name','slide','cate_blog'));
    }
    public function thuonghieu($slug)
    {
        $slide = Slide::all();
         $brand = BrandProduct::with('product')->where('brand_status','1')->take(10)->get();
        $brand_name = BrandProduct::with('product')->where('brand_status','1')->where('brand_slug',$slug)->first();
        $cate_blog = CategoryBlog::with('blog')->where('cate_blog_status','1')->get();
        $category = CategoryProduct::where('category_status','1')->get();
        $product = Product::with('category','brand')->where('product_status','1')->where('brand_id',$brand_name->id)->paginate(12);
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
        $related_product = Product::where('category_id',$product->category_id)->whereNotIn('id',[$product->id])->take(3)->get();
        $rating = Rating::where('product_id',$product->id)->avg('rating');
        $rating1=round($rating,1);
        $rating=round($rating);

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
}
