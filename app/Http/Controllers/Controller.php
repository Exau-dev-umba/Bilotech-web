<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function saveImage($image, $path='public'){
        if (!$image) {
            return null;
        }

        $filename=time().".png";

        //save the image
        //\Storage::disk($path)->put($filename, $image);
        \Storage::disk($path)->put($filename, file_get_contents($image));

        //return the path
        //url is the base url expected:localhost:8000
        return '/storage/'.$path.'/'.$filename;
    }
}
