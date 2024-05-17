<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class VendorAddress extends BaseModel
{
    use HasFactory;

    public $table = 'inventory.VendorAddress';

    public $guarded = [];

}
