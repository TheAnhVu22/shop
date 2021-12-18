<?php

namespace App\Http\Controllers;

use App\Models\BrandProduct;
use Illuminate\Http\Request;

class BrandProductController extends Controller
{
    public function index()
    {
        $brand = BrandProduct::orderBy('id','DESC')->get();
        return view('admincp.brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admincp.brand.create');
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
                'brand_name' => 'required|unique:brand_products|max:255',
                'brand_desc' => 'required',
                'brand_slug' => 'required',
                'brand_status' => 'required',
            ],
            [
                'brand_name.required' => 'Nhập tên danh mục',
                'brand_desc.required' => 'Nhập mô tả danh mục',
                
                'brand_name.unique' => 'Tên danh mục đã tồn tại',
                'brand_name.max' => 'Tối đa 255 ký tự',
            ]);
        $brand = new BrandProduct();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();
        return redirect()->back()->with('status','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandProduct  $BrandProduct
     * @return \Illuminate\Http\Response
     */
    public function show(BrandProduct $BrandProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandProduct  $BrandProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = BrandProduct::find($id);
        return view('admincp.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrandProduct  $BrandProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = $request->validate(
            [
                'brand_name' => 'required|max:255',
                'brand_desc' => 'required',
                'brand_slug' => 'required',
                'brand_status' => 'required',
            ],
            [
                'brand_name.required' => 'Nhập tên danh mục',
                'brand_desc.required' => 'Nhập mô tả danh mục',
                'brand_name.max' => 'Tối đa 255 ký tự',
            ]);
        $brand =  BrandProduct::find($id);
        $brand->brand_name = $data['brand_name'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();
        return redirect(route('brand.index'))->with('status','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandProduct  $BrandProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        BrandProduct::find($id)->delete();
        return redirect()->back()->with('status','Xóa thành công');
    }
}