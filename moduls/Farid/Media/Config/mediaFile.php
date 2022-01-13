<?php

return [

    "MediaTypeServices" => [
        "image" => [
            "extensions" => [
                "jpg" , "jpeg" , "png"
            ],
            "handler" => \Farid\Media\Services\ImageFileService::class
        ],

        "video" => [
            "extensions" => [
                "avi" , "mp4" , "mkv"
            ],
            "handler" => \Farid\Media\Services\VideoFileService::class
        ]
    ]
];
