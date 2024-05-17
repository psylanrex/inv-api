<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    use HasFactory;

    const INVOICED = 30;

    protected $table = 'inventory.ItemStatus';
    
}
