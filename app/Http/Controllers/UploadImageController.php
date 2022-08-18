<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;

class UploadImageController extends Controller
{
    private $images_path;
 
    public function __construct()
    {
        $this->images_path = public_path('/images');
    }
 
    /**
     * Display all of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Upload::all();
        return view('show', ['images'=>$images]);
    }
 
    /**
     * Show the form for creating uploading new images.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }
 
    /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $images = $request->file('file');
 
 
        for ($i = 0; $i < count($images); $i++) {
            $image = $images[$i];

            $imageName = 'article-'.time() . '.' . $image->getClientOriginalExtension();
            $resize_name =  Str::random(5) . '.' . $image->getClientOriginalExtension();
           
 
            Image::make($image)
                ->resize(250, null, function ($constraints) {
                    $constraints->aspectRatio();
                })
                ->save($this->images_path . '/' . $resize_name);
 
            $image->move($this->images_path, $imageName);

            //UPLOAD IN DB
            $upload = new Upload();
            $upload->filename = $imageName;
            $upload->resized_name = $resize_name;
            $upload->original_name = basename($image->getClientOriginalName());
            $upload->save();
        }

        return Response::json(['message' => 'Image saved Successfully'], 200);

    }
 
    /**
     * Remove the images from the storage.
     *
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $filename = $request->id;
        $uploaded_image = Upload::where('original_name', basename($filename))->first();
 
        if (empty($uploaded_image)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }
 
        $file_path = $this->images_path . '/' . $uploaded_image->filename;
        $resized_file = $this->images_path . '/' . $uploaded_image->resized_name;
 
        if (file_exists($file_path)) {
            unlink($file_path);
        }
 
        if (file_exists($resized_file)) {
            unlink($resized_file);
        }
 
        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }
 
        return Response::json(['message' => 'File successfully delete'], 200);
    }
}
