<?php

namespace App\Services\HdImages;

use App\Queries\HdImages\ListRejectedImagesQuery;

class ListRejectedImagesService
{

    public function listRejected()
    {

        return (new ListRejectedImagesQuery())->getData();
        
    }

}