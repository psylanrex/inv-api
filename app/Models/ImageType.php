<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    use HasFactory;

    const IMAGE_THREE       = 1;
    const IMAGE_FOUR        = 2;
    const IMAGE_FIVE        = 3;
    const IMAGE_SIX         = 4;
    const PRIMARY           = 5;
    const SECONDARY         = 6;
    const PRIMARY_THUMB     = 7;
    const SECONDARY_THUMB   = 8;
    const LISTING_THUMB     = 9;

    const HD_PRIMARY        = 24;
    const HD_SECONDARY      = 25;
    const HD_IMAGE_THREE    = 26;
    const HD_IMAGE_FOUR     = 27;
    const HD_SCALE          = 28;
    const HD_IMAGE_FIVE     = 29;
    const HD_IMAGE_SIX      = 30;


    public $table = 'inventory.ImageType';

    public function childImageTypes()
    {

        return $this->hasMany(self::class, 'made_from_id');

    }
    
}
