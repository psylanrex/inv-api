<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageStatus extends Model
{
    use HasFactory;

    const NONE      = 1;
    const REIMAGE   = 2;
    const DONE      = 3;
    const IMAGING   = 4;
    const REVIEW    = 5;
    const REJECTED  = 6;

    protected $table = 'inventory.ImageStatus';
    
}
