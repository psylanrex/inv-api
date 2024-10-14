<?php

namespace App\Http\Controllers\HdImages;

use App\Http\Controllers\Controller;
use App\Http\Requests\HdImagePostRequest;
use App\Services\HdImages\ListRejectedImagesService;
use App\Services\HdImages\GetImagesService;
use App\Services\HdImages\UploadImageService;

class HdImagesController extends Controller
{
    
    public function listRejected(ListRejectedImagesService $listRejectedImagesService)
    {

        return $listRejectedImagesService->listRejected();

    }

    public function getImages($product_id, GetImagesService $getImagesService)
    {

        return $getImagesService->getImages($product_id);

    }
 
    public function upload(HdImagePostRequest $request)
    {

        // return (new UploadImageService())->uploadImage($request);
        return ["success" => true, "code" => 200];
    }
      
}
