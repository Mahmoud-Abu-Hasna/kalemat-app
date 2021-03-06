<?php

namespace App\Http\Controllers;

use App\Logic\FileRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Validator;
use Intervention\Image\Facades\Image;
class ImageHandler extends Controller {





    function uploadImage(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|image',
        ]);

        if ($validator->fails()) {
            $json = [
                'status' => 0,
                'msg' => $validator->errors()->all()
            ];
        }else {
            $file = new FileRepository();
            $json = $file->multiple_upload();
        }
        return response()->json($json);
    }



    function uploadFile(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            $json = [
                'status' => 0,
                'msg' => $validator->errors()->all()
            ];
        }else {
            // $file = new FileRepository();
            $file = new \App\Logic\ImageRepository();
            $json = $file->uploadImage($request);
        }
        return response()->json($json);
    }

    function download($id){
        $path = storage_path('app/uploads/images/'.$id);
        return response()->file($path);
    }




    public function getPublicImage($type,$size, $id){
        try{
            $path = storage_path('app/images/'.$type.'/'.$id);

            if(!File::exists($path))
                $path = storage_path('app/images/default_image.jpg');

            if(!File::exists($path)) abort(404);

            $file = File::get($path);
            $type = File::mimeType($path);

            $sizes = explode("x", $size);

            if(is_numeric($sizes[0]) && is_numeric($sizes[1])){

                $manager = new ImageManager();


                $image = $manager->make( $file )->fit($sizes[0], $sizes[1], function ($constraint) {
                    $constraint->upsize();
                });
                $response = Response::make($image->encode($image->mime), 200);

                $response->header("CF-Cache-Status", 'HIF');
                $response->header("Cache-Control", 'max-age=604800, public');
//            $response->header("Content-Encoding", 'gzip');
                $response->header("Content-Type", $type);
//            $response->header("Vary", 'Accept-Encoding');

                return $response;

            }else { abort(404); }
        } catch (\League\Flysystem\Exception $e){
            //PDF file is stored under project/public/download/info.pdf
            $path = storage_path('app/images/'.$type.'/'.$id);

            return response()->file($path);

        }
    }

    public function getImageResize($size, $id){
        $path = storage_path('app/uploads/images/'.$id);

        if(!File::exists($path))
            $path = storage_path('app/uploads/images/default_image.jpg');

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        if(is_numeric($size)){

            $manager = new ImageManager();
            $image = $manager->make( $file );
            $height = $image->height();
            $width = $image->width();
            if($width > $height){
                $new_height = (($height * $size)/$width);
                $image = $image->resize($size, $new_height, function ($constraint) {
                    $constraint->upsize();
                });

            }else{
                $new_width = (($width * $size)/$height);
                $image = $image->resize($new_width, $size, function ($constraint) {
                    $constraint->upsize();
                });
            }

            $response = Response::make($image->encode($image->mime), 200);

            $response->header("CF-Cache-Status", 'HIF');
            $response->header("Cache-Control", 'max-age=604800, public');
            $response->header("Content-Type", $type);

            return $response;

        }else { abort(404); }
    }


    public function getImageResize1($size, $id){
        $path = storage_path('app/uploads/images/'.$id);

        if(!File::exists($path))
            $path = storage_path('app/uploads/images/default_image.jpg');

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        if(is_numeric($size)){

            $manager = new ImageManager();
            $image = $manager->make( $file );
            $height = $image->height();
            $width = $image->width();
            if($width > $height){

                $new_height = (($height * $size)/$width);
                $image = $image->resize($size, $new_height, function ($constraint) {
                    $constraint->upsize();
                });


            }else{

                $new_width = (($width * $size)/$height);
                $image = $image->resize($new_width, $size, function ($constraint) {
                    $constraint->upsize();
                });
            }

            $response = Response::make($image->encode($image->mime), 200);

            $response->header("CF-Cache-Status", 'HIF');
            $response->header("Cache-Control", 'max-age=604800, public');
            $response->header("Content-Type", $type);

            return $response;

        }else { abort(404); }
    }

    public function getDefaultImage($type='',$id){
        $path = storage_path('app/images/'.$type.'/'.$id);

        if(!File::exists($path)) abort(404);

        $file = File::get($path);

        $type = File::mimeType($path);

        $manager = new ImageManager();
        $image = $manager->make( $file );
        $response = Response::make($image->encode($image->mime), 200);
        $response->header("CF-Cache-Status", 'HIF');
        $response->header("Cache-Control", 'max-age=604800, public');
//            $response->header("Content-Encoding", 'gzip');
        $response->header("Content-Type", $type);
//            $response->header("Vary", 'Accept-Encoding');

        return $response;

    }
}
