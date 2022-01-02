<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\CategoryBlog;
class BlogController extends Controller
{

    public function index()
    {
        $blog= Blog::with('categoryblog')->orderBy('id','DESC')->get();
        return view('admincp.blog.index',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate_blog = CategoryBlog::orderBy('id','DESC')->where('cate_blog_status',1)->get();
        return view('admincp.blog.create',compact('cate_blog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = $request->validate(
            [
                'blog_name' => 'required|unique:blogs|max:255',
                'blog_author' => 'required|max:255',
                'blog_desc' => 'required',
                'blog_slug' => 'required',
                'cate_blog_slug' => 'required',                
                'blog_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000',
            ],
            [
                'blog_name.required' => 'Nhập tên',
                'blog_desc.required' => 'Nhập mô tả',
                'blog_image.required' => 'Chọn ảnh',
                'blog_image.mimes' => 'Chỉ nhận ảnh',
                'blog_author.required' => 'Nhập tên tác giả',
                'blog_name.unique' => 'Tên đã tồn tại',
                'blog_name.max' => 'Tối đa 255 ký tự',
            ]);
        $blog = new Blog();
        $blog->blog_name = $data['blog_name'];
        $blog->blog_desc = $data['blog_desc'];
        $blog->blog_author = $data['blog_author'];
        $blog->blog_slug = $data['blog_slug'];
        $blog->cate_blog_id = $data['cate_blog_slug'];
        // xử lý ảnh
        $get_image = $request->blog_image; 
        $path = 'uploads/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $blog->blog_image=$new_image;
        $blog->save();
        return redirect()->back()->with('status','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog= Blog::find($id);
        $cate_blog = CategoryBlog::orderBy('id','DESC')->where('cate_blog_status',1)->get();
        return view('admincp.blog.edit',compact('blog','cate_blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate(
            [
                'blog_name' => 'required|max:255',
                'blog_author' => 'required|max:255',
                'blog_desc' => 'required',
                'blog_slug' => 'required',
                'cate_blog_slug' => 'required',                
                'blog_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000',
            ],
            [
                'blog_name.required' => 'Nhập tên',
                'blog_desc.required' => 'Nhập mô tả',               
                'blog_image.mimes' => 'Chỉ nhận ảnh',
                'blog_author.required' => 'Nhập tên tác giả',              
                'blog_name.max' => 'Tối đa 255 ký tự',
            ]);
        $blog = Blog::find($id);
        $blog->blog_name = $data['blog_name'];
        $blog->blog_desc = $data['blog_desc'];
        $blog->blog_author = $data['blog_author'];
        $blog->blog_slug = $data['blog_slug'];
        $blog->cate_blog_id = $data['cate_blog_slug'];
        // xử lý ảnh
        $get_image = $request->blog_image; 
        if($get_image){
        $path = 'uploads/'.$blog->blog_image;
        if (file_exists($path)) {
           unlink($path);
       }
        $path = 'uploads/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $blog->blog_image=$new_image;
        }
        $blog->save();
        return redirect(route('blog.index'))->with('status','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
       $path = 'uploads/'.$blog->blog_image;
       if (file_exists($path)) {
           unlink($path);
       }
       Blog::find($id)->delete();
       return redirect()->back()->with('status',"xóa thành công");
    }
}