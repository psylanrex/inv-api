<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends BaseModel
{
    use HasFactory;

    public $table = 'inventory.Vendor';

    public $guarded = [];

    public function vendorAddresses()
    {

        return $this->hasMany(VendorAddress::class);

    }

    public function vendorContacts()
    {

        return $this->hasMany(VendorContact::class);

    }

}
