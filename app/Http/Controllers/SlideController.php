<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index()
    {
        $slide= Slide::orderBy('id','DESC')->get();
        return view('admincp.slide.index',compact('slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.slide.create');
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
                'slide_name' => 'required|unique:Slides|max:255',
                
                'slide_desc' => 'required',
                             
                'slide_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000',
            ],
            [
                'slide_name.required' => 'Nhập tên',
                'slide_desc.required' => 'Nhập mô tả',
                'slide_image.required' => 'Chọn ảnh',
                'slide_image.mimes' => 'Chỉ nhận ảnh',
                'slide_name.unique' => 'Tên đã tồn tại',
                'slide_name.max' => 'Tối đa 255 ký tự',
            ]);
        $slide = new Slide();
        $slide->slide_name = $data['slide_name'];
        $slide->slide_desc = $data['slide_desc'];

        // xử lý ảnh
        $get_image = $request->slide_image; 
        $path = 'uploads/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $slide->slide_image=$new_image;
        $slide->save();
        return redirect()->back()->with('status','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $Slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $Slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $Slide
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $slide= Slide::find($id);
        return view('admincp.slide.edit',compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $Slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate(
            [
                'slide_name' => 'required|max:255',
                
                'slide_desc' => 'required',
                         
                'slide_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height:100,max_width:1000,max_height:1000',
            ],
            [
                'slide_name.required' => 'Nhập tên',
                'slide_desc.required' => 'Nhập mô tả',               
                'slide_image.mimes' => 'Chỉ nhận ảnh',
               
                'slide_name.max' => 'Tối đa 255 ký tự',
            ]);
        $slide = Slide::find($id);
        $slide->slide_name = $data['slide_name'];
        $slide->slide_desc = $data['slide_desc'];

        // xử lý ảnh
        $get_image = $request->slide_image; 
        if($get_image){
        $path = 'uploads/'.$slide->slide_image;
        if (file_exists($path)) {
           unlink($path);
       }
        $path = 'uploads/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $slide->slide_image=$new_image;
        }
        $slide->save();
        return redirect(route('slide.index'))->with('status','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $Slide
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $slide = Slide::find($id);
       $path = 'uploads/'.$slide->slide_image;
       if (file_exists($path)) {
           unlink($path);
       }
       Slide::find($id)->delete();
       return redirect()->back()->with('status',"xóa thành công");
    }
}