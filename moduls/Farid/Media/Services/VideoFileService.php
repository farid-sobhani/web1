<?php


namespace Farid\Media\Services;


use Illuminate\Support\Facades\Storage;

class VideoFileService
{
    public static function upload($file)
    {
        $filename = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'app\public\\';
        $file->move(storage_path($dir),$filename.'.'.$extension);
        $path = $dir.'\\'.$filename.'.'.$extension;

        return $filename.'.'.$extension;


    }

    public static function delete($media)
    {


            Storage::delete('public\\'.$media->file);




    }

}
