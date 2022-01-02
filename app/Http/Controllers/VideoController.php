<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
class VideoController extends Controller
{
    public function video()
    {
        
        return view('admincp.video.listvideo');
    }
    public function update_video(Request $request)
    {

        $data = $request->all();
        $id = $data['video_id'];
        $type = $data['video_type'];
        $text = $data['video_text'];
        $video = Video::find($id);
        if($type == "video_title"){
            $video->video_title=$text;
        }elseif($type == "video_slug"){
            $video->video_slug=$text;
        }
        elseif($type == "video_link"){
            $video->video_link=$text;
        }else{
            $video->video_desc=$text;
        }
        $video->save();
    }
    public function select_video(Request $request)
    {
        $video = Video::all();
        $output ='<div class="table-responsive">
                <table class="table align-items-center">
                  <thead>
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">Title video</th>
                      <th class="text-center">slug video</th>
                      <th class="text-center">Link</th>
                      <th class="text-center">mô tả</th>
                      <th class="text-center">Xem</th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>';
        foreach ($video as $key => $dulieu) {
            $link = $tomtat=substr($dulieu->video_link, 17,100);
            $output.='<tr>
                      
                      <td class="text-center" >
                        '.$key.'
                      </td>
                      <td class="text-center video_edit" contenteditable id="video_title_'.$dulieu->id.'" data-video_type="video_title" data-video_id="'.$dulieu->id.'">
                        '.$tomtat=substr($dulieu->video_title, 0,50).'
                      </td class="text-center">
                      <td class="text-center video_edit" contenteditable id="video_slug_'.$dulieu->id.'" data-video_type="video_slug" data-video_id="'.$dulieu->id.'">
                        '.$tomtat=substr($dulieu->video_slug, 0,30).'
                      </td class="text-center">
                      <td class="text-center video_edit" contenteditable id="video_link_'.$dulieu->id.'" data-video_type="video_link" data-video_id="'.$dulieu->id.'">
                        '.$dulieu->video_link.'
                      </td>
                      <td class="text-center video_edit" contenteditable id="video_desc_'.$dulieu->id.'" data-video_type="video_desc" data-video_id="'.$dulieu->id.'">
                        '.$tomtat=substr($dulieu->video_desc, 0,55).'              
                      </td>
                      <td class="text-center">
                       <iframe width="200" height="200" src="https://www.youtube.com/embed/'.$link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      </td>
                      <td class="text-center">
                       <button type="button" data-video_id="'.$dulieu->id.'" name="xoavideo" class="btn btn-danger xoavideo">Xóa</button>
                      </td>

                    </tr>';
        }
        $output.='</tbody>
                </table>
              </div>';
        return $output;
    }
    public function xoa_video(Request $request)
    {
        $id = $request->video_id;
        $video = Video::find($id)->delete();

    }
    public function them_video(Request $request)
    {
        $title= $request->video_title;
        $slug= $request->video_slug;
        $link= $request->video_link;
        $desc= $request->video_desc;
        $video = new Video();
        $video->video_title=$title;
        $video->video_slug=$slug;
        $video->video_link=$link;
        $video->video_desc=$desc;
        $video->save();
    }
}
