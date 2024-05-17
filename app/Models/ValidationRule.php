<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationRule extends Model
{
    use HasFactory;

    const REQUIRED      = 1;
    const REQUIRED_IF   = 2;
    const MIN           = 3;
    const MAX           = 4;
    const DIGITS        = 5;
    const ALPHA_DASH    = 6;
    const NUMERIC       = 7;
    const REQUIRED_WITH = 8;

    public $table = 'inventory.ValidationRule';
    
}
