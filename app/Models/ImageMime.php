<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageMime extends Model
{
    use HasFactory;

    const JPEG  = 1;
    const GIF   = 2;

    protected $table = 'inventory.ImageMime';
    
}
