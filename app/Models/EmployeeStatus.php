<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    use HasFactory;

    const ACTIVE    = 1;
    const DUMP      = 2;

    public $table = 'inventory.EmployeeStatus';
    
}
