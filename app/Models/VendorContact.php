<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class VendorContact extends BaseModel
{
    use HasFactory, Notifiable;

    public $table = 'inventory.VendorContact';

    public $guarded = [];

    public $timestamps = false;

    public function user()
    {

        return $this->belongsTo(User::class, 'vendor_id', 'vendor_id');

    }

}
