<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipMethod extends BaseModel
{
    use HasFactory;

    const PENDING = 5;

    protected $table = 'inventory.ShipMethod';

}
