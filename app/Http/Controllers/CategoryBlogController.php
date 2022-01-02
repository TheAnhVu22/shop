<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use Illuminate\Http\Request;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate_blog = CategoryBlog::orderBy('id','DESC')->get();
        return view('admincp.cate_blog.index',compact('cate_blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.cate_blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $cate = new CategoryBlog();
        $cate->cate_blog_name = $data['cate_blog_name'];
        $cate->cate_blog_slug = $data['cate_blog_slug'];
        $cate->cate_blog_status = $data['cate_blog_status'];
        $cate->save();
        return redirect()->back()->with('status','thêm danh mục bài viết thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryBlog  $categoryBlog
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryBlog $categoryBlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryBlog  $categoryBlog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate_blog = CategoryBlog::find($id);
        return view('admincp.cate_blog.edit',compact('cate_blog')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryBlog  $categoryBlog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->all();
        $cate =  CategoryBlog::find($id);
        $cate->cate_blog_name = $data['cate_blog_name'];
        $cate->cate_blog_slug = $data['cate_blog_slug'];
        $cate->cate_blog_status = $data['cate_blog_status'];
        $cate->save();
        return redirect()->back()->with('status','sửa danh mục bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryBlog  $categoryBlog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryBlog::find($id)->delete();
        return redirect()->back()->with('status','xóa danh mục bài viết thành công');
    }
}
