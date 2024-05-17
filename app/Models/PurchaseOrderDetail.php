<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrderDetail extends BaseModel
{
    use HasFactory;

    protected $table = 'inventory.PurchaseOrderDetail';

    protected $guarded = [];

    protected $has_create_user_id = false;
    protected $has_update_user_id = false;

}
