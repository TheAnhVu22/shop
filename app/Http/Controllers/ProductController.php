<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BrandProduct;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Rating;
use Brian2694\Toastr\Facades\Toastr;
class ProductController extends Controller
{
    public function __construct()
    {
        // có 1 trong các quyền này thì sẽ vào đc index + show
        $this->middleware('permission:view product|edit product|delete product|add product',['only' => ['index','show']]);
        // với mỗi quyền thì có các chức năng riêng nữa
         $this->middleware('permission:add product', ['only' => ['create','store']]);
         $this->middleware('permission:edit product', ['only' => ['edit','update']]);
         $this->middleware('permission:delete product', ['only' => ['destroy']]);
    }
    public function index()
    {
        $product= Product::with('category','brand')->orderBy('id','DESC')->get();
        return view('admincp.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = CategoryProduct::all();
        $brand = BrandProduct::all();
        return view('admincp.product.create',compact('category','brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // $request->product_price = filter_var($request->product_price,FILTER_SANITIZE_NUMBER_INT);
            // $request->product_quantity = filter_var($request->product_quantity,FILTER_SANITIZE_NUMBER_INT);
            
         $data = $request->validate(
            [
                'product_content' => 'required|unique:products|max:255',
                'product_desc' => 'required',
                'product_slug' => 'required',
                'product_tags' => 'required',
                'product_quantity' => 'required|integer',
                'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000',

                'product_price' => 'required|integer',
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_status' => 'required',
            ],
            [
                'product_content.required' => 'Nhập tên danh mục',
                'product_desc.required' => 'Nhập mô tả danh mục',
                'product_image.required' => 'Chọn ảnh',
                'product_image.mimes' => 'Chỉ nhận ảnh',
                'product_price.required' => 'Nhập giá',
                'product_quantity.required' => 'Nhập số lượng',
                'product_quantity.integer' => 'Chỉ nhập số lượng là số',
                'product_content.unique' => 'Tên danh mục đã tồn tại',
                'product_content.max' => 'Tối đa 255 ký tự',
            ]);

        $product = new Product();
        $product->product_content = $data['product_content'];
        $product->product_desc = $data['product_desc'];
        $product->product_tags = $data['product_tags'];
        $product->product_price = $data['product_price'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        $product->product_status = $data['product_status'];
        $product->product_slug = $data['product_slug'];
        $product->product_quantity = $data['product_quantity'];
        // xử lý ảnh
        $get_image = $request->product_image; 
        $path = 'uploads/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $product->product_image=$new_image;
        $product->save();
        Toastr::success('Thêm sản phẩm thành công','Thành công');
        return redirect()->back()->with('status','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $product= Product::find($id);
         $category = CategoryProduct::orderBy('id','DESC')->get();
         $brand = BrandProduct::orderBy('id','DESC')->get();
        return view('admincp.product.edit',compact('product','category','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate(
            [
                'product_content' => 'required|max:255',
                'product_desc' => 'required',
                'product_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000',
                'product_tags' => 'required',
                'product_slug' => 'required',
                'product_quantity' => 'required|integer',
                'product_price' => 'required|integer',
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_status' => 'required',
            ],
            [
                'product_content.required' => 'Nhập tên danh mục',
                'product_desc.required' => 'Nhập mô tả danh mục',
                'product_quantity.required' => 'Nhập số lượng',
                'product_quantity.integer' => 'Chỉ nhập số lượng là số',
                'product_image.mimes' => 'Chỉ nhận ảnh',
                'product_price.required' => 'Nhập giá',
               
                'product_content.unique' => 'Tên danh mục đã tồn tại',
                'product_content.max' => 'Tối đa 255 ký tự',
            ]);
        $product = Product::find($id);
        $product->product_content = $data['product_content'];
        $product->product_desc = $data['product_desc'];
        $product->product_price = $data['product_price'];
        $product->product_tags = $data['product_tags'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        $product->product_status = $data['product_status'];
        $product->product_slug = $data['product_slug'];
        $product->product_quantity = $data['product_quantity'];
        // xử lý ảnh
        $get_image = $request->product_image; 
        if($get_image){
        $path = 'uploads/'.$product->product_image;
        if (file_exists($path)) {
           unlink($path);
       }
        $path = 'uploads/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $product->product_image=$new_image;
        }
        $product->save();
        Toastr::success('Cập nhật sản phẩm thành công','Thành công');
        return redirect(route('product.index'))->with('status','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $product = Product::find($id);
       $path = 'uploads/'.$product->product_image;
       if (file_exists($path)) {
           unlink($path);
       }
       Product::find($id)->delete();
       return redirect()->back()->with('status',"xóa thành công");
    }
    public function load_comment(Request $request)
    {
        $data = $request->all();
        $id = $data['pro_id'];
        $output="";
        $comment = Comment::where('product_id',$id)->where('comment_parent',null)->orderby('id','DESC')->get();
        $comment_child = Comment::with('product')->where('comment_parent','!=',null)->orderBy('id','ASC')->get();
        foreach ($comment as $key => $value) {
            $output.='<div class="row xx1">
                                        <div class="col-sm-2">
                                            <img src="'.asset('img/iconuser.png').'" width="100%" alt="" class="img-responsive">
                                        </div>
                                        <div class="col-sm-10">
                                            <p style="color:green"><i class="fas fa-user"></i> '.$value->comment_name.' - '.$value->created_at.'</p>
                                            <p>'.$value->comment_content.'</p>
                                            
                                        </div>
                                        </div>';
            foreach ($comment_child as $k => $va) {
                if($va->comment_parent==$value->id){                    
            $output.=' <div class="row xx1" style="margin: 5px 40px;">
                        <div class="col-sm-2" >
                                    <img src="'.asset('img/iconadmin.png').'" width="50%" alt="" class="img-responsive">
                                    </div>
                                    <div class="col-sm-10">
                                        <p style="color:red;"><i class="fas fa-user"></i> '.$va->comment_name.' - '.$va->created_at.'</p>
                                        <p>'.$va->comment_content.'</p>
                                        
                                    </div> 
                                    </div>';
                    }                   
                } 
            $output.=' <br>';
        }
        return $output;
    }
    public function them_binhluan(Request $request)
    {
        $data= $request->all();       
        $comment = new Comment();
        $comment->comment_name = $data['comment_name'];
        $comment->comment_content = $data['comment_content'];
        $comment->product_id = $data['pro_id'];
        $comment->save();
    }
    public function binh_luan()
    {
        $comment = Comment::with('product')->where('comment_parent',null)->orderBy('id','DESC')->get();
        $comment_child = Comment::with('product')->where('comment_parent','!=',null)->orderBy('id','ASC')->get();
        return view('admincp.product.binhluan',compact('comment','comment_child'));
    }
    public function xoa_binhluan(Request $request)
    {
        $data= $request->all();
        Comment::find($data['com_id'])->delete();
        Comment::where('comment_parent',$data['com_id'])->delete();
    }
    public function traloi_binhluan(Request $request)
    {
        $data= $request->all();
        $comment = new Comment();
        $comment->comment_name = "ATVshop";
        $comment->comment_content = $data['comment_reply'];
        $comment->product_id = $data['pro_id'];
        $comment->comment_parent = $data['com_id'];
        $comment->save();
    }
    public function insert_rating(Request $request)
    {
        $data= $request->all();
        $rating = new Rating();
        $rating->product_id=$data['product_id'];
        $rating->rating=$data['index'];
        $rating->save();
        return 'ok';
    }
    public function file_browser(Request $request)
    {
        $paths = glob(public_path('public/uploads/ckeditor/*'));
        $fileNames = array();
        foreach ($paths as $path) {
            array_push($fileNames, basename($path));
        }
        $data = array(
            'fileNames' => $fileNames
        );
        return view('admincp.image.file_browser')->with($data);
    }
    public function uploads_ckeditor(Request $request)
    {
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName,PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move('public/uploads/ckeditor',$fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/ckeditor/'.$fileName);
            $msg ="Tải ảnh thành công";
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-Type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
