<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Icon;
class IconController extends Controller
{
    public function icon()
    {
        return view('admincp.icon.index');
    }
    public function select_icon(Request $request)
    {
        $icon = Icon::all();
        $output='<div class="table-responsive">
                <table class="table align-items-center" id="xxx">
                  <thead>
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">Tên</th>
                      <th class="text-center col-3">Link</th>
                      <th class="text-center">Ảnh</th>
                      
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>';
        foreach ($icon as $value => $dulieu) {
            $output.='<tr>

                      <td class="text-center">
                        '.$value.'
                      </td>

                      <td class="text-center edit_icon" contenteditable id="edit_name_'.$dulieu->id.'" data-type="name" data-icon_id="'.$dulieu->id.'">
                         '.$dulieu->name.'
                      </td>

                      <td class="text-center edit_icon" contenteditable id="edit_link_'.$dulieu->id.'" data-type="link" data-icon_id="'.$dulieu->id.'">
                         '.$dulieu->link.'
                      </td>

                      <td class="text-center">
                         <img src="'.asset("uploads/".$dulieu->image).'" width="100" height="100">
                         <input type="file" data-icon_id="'.$dulieu->id.'" class="file" id="file-'.$dulieu->id.'">
                      </td>
                      
                      
                      <td class="text-center">                       
                          <button id="'.$dulieu->id.'" class="btn btn-sm btn-danger" type="button" onclick="delete_icon(this.id)">Xóa</button>
                        
                      </td>

                    </tr>';
        }
        $output.='</tbody>
                </table>
              </div>
            </div>';
        return $output;
    }
    public function add_icon(Request $request)
    {
        $get_image = $request->file('file');
        $data= $request->all();
        $icon = new Icon();
        if($get_image){
        $path = 'uploads/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $icon->image = $new_image;
        }
        $icon->name = $data['name'];
        $icon->link = $data['link'];
        $icon->save();
    }
    public function delete_icon(Request $request)
    {
        $data = $request->all();
        Icon::find($data['id'])->delete();
    }
    public function edit_icon(Request $request)
    {
        $data = $request->all();
        $icon = Icon::find($data['id']);
        if($data['type']=='name'){
            $icon->name = $data['text'];
        }else{
            $icon->link = $data['text'];
        }
        $icon->save();
    }
    public function edit_img(Request $request)
    {
        $data = $request->all();
        $icon = Icon::find($data['id']);
        $get_image = $request->file('file');
        if($get_image){
        $path = 'uploads/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $icon->image = $new_image;
        }
        $icon->save();
    }
}
