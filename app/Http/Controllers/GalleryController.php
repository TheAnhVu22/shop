<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Product;
class GalleryController extends Controller
{
    public function select_gallery(Request $request)
    {
        $pro_id= $request->pro_id;
        $gallery = Gallery::where('product_id',$pro_id)->get();
        $gallery_count = $gallery->count();
        $output = '<form> '.csrf_field().'
                    <div class="table-responsive">
                    <table class="table align-items-center">
                          <thead>
                            <tr>
                              <th class="text-center">STT</th>
                              <th class="text-center">Tên hình ảnh</th>
                              <th class="text-center">Hình Ảnh</th>
                              <th class="text-center"></th>
                              <th class="text-center"></th>
                            </tr>
                          </thead>
                          <tbody>';
        if ($gallery_count>0) {
            $i=0;
            foreach ($gallery as $key => $value) {
                $i++;
                $anh = asset('uploads/'.$value->gallery_image);
                $output.='
                            <tr> 
                            <td class="text-center">'.$i.'</td>
                            <td data-gal_id="'.$value->id.'" class="text-center edit_gal_name" contenteditable>'.$value->gallery_name.'</td>
                            <td class="text-center"><img src="'.$anh.'" width="100px" height="100px">
                               <input type="file" class="file_image" style="width:40%;" data-gal_id="'.$value->id.'" id="file-'.$value->id.'" name="file" accept="image/*"> 
                            </td>
                            <td></td>
                            <td class="text-center">
                                <button type="button" data-gal_id="'.$value->id.'" class="btn btn-danger delete-gallery">Xóa</button>
                            </td>
                            </tr>
                            ';
            }
        }else{
            $output.='<tr> 
                            <td colspan="4">Sản phẩm chưa có ảnh nào</td>
                            
                            </tr>';
        }
        $output.='</body>
                    </table>
                    </div>
                    </form>';
                    return $output;
    }
    public function insert_gallery(Request $request,$pro_id)
    {
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $key) {
        $path = 'uploads/';
        $get_name_image = $key->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$key->getClientOriginalExtension();
        $key->move($path,$new_image);
        $gallery = new Gallery();
        $gallery->gallery_image=$new_image;
        $gallery->gallery_name=$new_image;
        $gallery->product_id=$pro_id;
        $gallery->save();
        
            }
        }
        return redirect()->back()->with('status','Thêm thành công');
    }
    public function update_gallery_name(Request $request)
    {
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();
    }
    public function delete_gallery(Request $request)
    {
        $gal_id = $request->gal_id;

        $gallery = Gallery::find($gal_id);
        unlink('uploads/'.$gallery->gallery_image);
        $gallery->delete();
    }

    public function update_gallery(Request $request)
    {
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        
        if($get_image){
            $path = 'uploads/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $gallery = Gallery::find($gal_id);
            unlink('uploads/'.$gallery->gallery_image);
            $gallery->gallery_image=$new_image;          
            $gallery->save();
        }
    }
    public function index()
    {
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $pro_id = $product_id;
        return view('admincp.gallery.add_gallery',compact('pro_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pro_id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
