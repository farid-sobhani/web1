<?php


namespace Farid\Media\Services;


use phpDocumentor\Reflection\Types\Self_;
use Farid\Media\Models\Media;

//todo refactor module

class MediaFileService
{
    public static function upload($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());



        foreach (config('mediaFile.MediaTypeServices') as $key => $value) {
            if (in_array($extension, $value['extensions'])) {

                return self::uploadHandler($key,$file,$value['handler']);

            }
        }


    }

    public static function uploadHandler($type,$file,$handler)
    {

        $media = new Media();
        $media->user_id = auth()->id();
        $media->type = $type;
        $media->file = $handler::upload($file);
        $media->filename = $file->getClientOriginalExtension();
        $media->save();
        return $media->id;
    }

    public static function delete($media)
    {

        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if ($media->type == $type) {
                return $service['handler']::delete($media);
            }
        }




    }

}
