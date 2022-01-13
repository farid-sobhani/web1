<?php


namespace Farid\Media\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageFileService
{
    public static function upload($file)
    {
        $filename = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'app\public\\';
        $file->move(storage_path($dir),$filename.'.'.$extension);
        $path = $dir.'\\'.$filename.'.'.$extension;
        $img = Image::make(storage_path($path))->resize('300',null,function ($aspect){
            $aspect->aspectRatio();
        })->save(storage_path($dir).$filename.'_300'.'.'.$extension);
        $images = [
            'original' => $filename.'.'.$extension,
            '300' => $filename.'_300'.'.'.$extension

        ];
        return $images;


    }

    public static function delete($media)
    {

        foreach ($media->file as $file){

            Storage::delete('public\\'.$file);
        }



    }

}
