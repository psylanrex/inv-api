<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JewelryMount extends Model
{
    use HasFactory;

    const RING      = 1;
    const NECKLACE  = 2;
    const BRACELET  = 3;

    public $table = 'inventory.JewelryMount';

    public function mountMeasureUnit()
    {

        return $this->belongsTo(MountMeasureUnit::class);
        
    }

}
