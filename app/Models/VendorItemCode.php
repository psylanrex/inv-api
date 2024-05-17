<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorItemCode extends Model
{
    use HasFactory;

    public $table = 'inventory.VendorItemCode';

    public $guarded = [];

    public $timestamps = false;
    
}
