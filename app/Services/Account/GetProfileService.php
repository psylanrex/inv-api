<?php

namespace App\Services\Account;

use App\Models\Vendor;

class GetProfileService
{
    public function getProfile()
    {
        
        $vendor_id = auth()->user()->vendor_id;

        return  Vendor::with('vendorAddresses', 'vendorContacts')->find($vendor_id);

    }

}