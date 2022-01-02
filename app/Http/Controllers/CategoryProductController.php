<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function __construct()
    {
        // với mỗi quyền thì có các chức năng riêng nữa
         $this->middleware('permission:add category brand', ['only' => ['create','store']]);
         $this->middleware('permission:edit delete category brand', ['only' => ['edit','update','destroy']]);
         
    }
    public function index()
    {
        $category = CategoryProduct::orderBy('id','DESC')->get();
        return view('admincp.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admincp.category.create');
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
                'category_name' => 'required|unique:category_products|max:255',
                'category_desc' => 'required',
                'category_slug' => 'required',
                'category_status' => 'required',
            ],
            [
                'category_name.required' => 'Nhập tên danh mục',
                'category_desc.required' => 'Nhập mô tả danh mục',
                
                'category_name.unique' => 'Tên danh mục đã tồn tại',
                'category_name.max' => 'Tối đa 255 ký tự',
            ]);
        $category = new CategoryProduct();
        $category->category_name = $data['category_name'];
         $category->category_slug = $data['category_slug'];
        $category->category_desc = $data['category_desc'];
        $category->category_status = $data['category_status'];
        $category->save();
        return redirect()->back()->with('status','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProduct $categoryProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryProduct::find($id);
        return view('admincp.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = $request->validate(
            [
                'category_name' => 'required|max:255',
                'category_desc' => 'required',
                'category_slug' => 'required',
                'category_status' => 'required',
            ],
            [
                'category_name.required' => 'Nhập tên danh mục',
                'category_desc.required' => 'Nhập mô tả danh mục',
                'category_name.max' => 'Tối đa 255 ký tự',
            ]);
        $category =  CategoryProduct::find($id);
        $category->category_name = $data['category_name'];
        $category->category_slug = $data['category_slug'];
        $category->category_desc = $data['category_desc'];
        $category->category_status = $data['category_status'];
        $category->save();
        return redirect(route('category.index'))->with('status','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        CategoryProduct::find($id)->delete();
        return redirect()->back()->with('status','Xóa thành công');
    }
}
