<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Storage;
use File;
class DocumentController extends Controller
{
    
public function upload_file()
    {
       $filename = "Latex.pdf";
       $filePath = public_path('uploads/latex.pdf');
       $fileData = File::get($filePath);
       Storage::cloud()->put($filename, $fileData);
       dd('file pdf uploaded');
    }
    public function upload_image()
    {
        $filename = "Ảnh test";
       $filePath = public_path('uploads/sachdat90.png');
       $fileData = File::get($filePath);
       Storage::cloud()->put($filename, $fileData);
       dd('file ảnh uploaded');
    }

    public function upload_video()
    {
        $filename = "Video test";
       $filePath = public_path('uploads/sachdat90.png');
       $fileData = File::get($filePath);
       Storage::cloud()->put($filename, $fileData);
       dd('file ảnh uploaded');
    }

    public function download_document($path,$name)
    {
       $filename = $name;
       $dir = '/';
       $recursive= false; //có lấy file trong các thư mục con không
       $contents = collect(Storage::cloud()->listContents($dir,$recursive))->where('type','=','file')->where('path','=',$path)->first();

       // $file = $contents->where('type','=','file')->where('filename','=',pathinfo($filename, PATHINFO_FILENAME))->where('extension','=',pathinfo($filename, PATHINFO_EXTENSION))->first(); //có thể bị trùng tên file với nhau

       $rawData= Storage::cloud()->get($path);
       return response($rawData,200)->header('Content-Type',$contents['mimetype'])->header('Content-Disposition',"attachment; filename = $filename");
       return redirect()->back();
    }

    public function create_document()
    {
        Storage::cloud()->put('test.txt', 'Anh the');
        
        dd('created');
    }

    public function list_document()
    {
       
       $dir = '/'; // vào thư mục gốc
       $recursive= true; //có lấy file trong các thư mục con không
       $contents = collect(Storage::cloud()->listContents($dir,$recursive));
       return $contents;
    }

    public function read_document()
    {
       $fileinfo = collect(Storage::cloud()->listContents('/',false))->where('type','file')->where('name','test.txt')->first();
       $content = Storage::cloud()->get($fileinfo['path']);
       dd($content);
    }

    public function delete_document($path)
    {
       $fileinfo = collect(Storage::cloud()->listContents('/',false))->where('type','file')->where('path',$path)->first();
       Storage::cloud()->delete($fileinfo['path']);
       return redirect()->back();
    }

    public function create_folder(){
        Storage::cloud()->makeDirectory('document_new');
       dd('created folder');
    }

    public function rename_folder()
    {
       $folderinfo = collect(Storage::cloud()->listContents('/',false))->where('type','dir')->where('name','document_new')->first();
       Storage::cloud()->move($folderinfo['path'],'document');
       dd('renamed folder');
    }

    public function delete_folder()
    {
       $folderinfo = collect(Storage::cloud()->listContents('/',false))->where('type','dir')->where('name','document')->first();
       Storage::cloud()->delete($folderinfo['path']);
       dd('deleted folder');
    }

    public function read_data()
    {
        $dir = '/'; // vào thư mục gốc
       $recursive= true; //có lấy file trong các thư mục con không
       $contents = collect(Storage::cloud()->listContents($dir,$recursive));
       return view('admincp.document.read', compact('contents'));
    }
}
