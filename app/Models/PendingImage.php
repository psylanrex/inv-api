<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class PendingImage extends BaseModel
{
    use HasFactory;

    protected $table = 'inventory.PendingImages';
    
    public $guarded = [];

}
