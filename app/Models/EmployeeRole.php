<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRole extends Model
{
    use HasFactory;

    const ADMIN         = 8;
    const PURCHASING    = 3;

    public $table = 'inventory.EmployeeRole';
    
}
