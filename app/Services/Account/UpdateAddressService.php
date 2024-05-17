<?php

namespace App\Services\Account;

use Illuminate\Support\Facades\DB;
use App\Models\VendorAddress;
use Illuminate\Support\Facades\Auth;

class UpdateAddressService
{
    public function updateAddress($request)
    {
        $vendor_id = auth()->user()->vendor_id;

        // Start transaction!
        
        DB::beginTransaction();

        try {

            foreach ($request->get('address') AS $index => $value) {

                // Build the update / create params array

                $params = [

                    'vendor_id' => $vendor_id,
                    'address' => $request->get('address')[$index],
                    'city' => $request->get('city')[$index],
                    'state' => $request->get('state')[$index],
                    'zip_code' => $request->get('zip')[$index],
                    'create_user_id' => Auth::user()->id,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_user_id' => Auth::user()->id,
                    'update_time' => date('Y-m-d H:i:s')

                ];

                // Determine the type chosen

                switch ($request->get('type')[$index]) {

                    case 0: // Primary
                        $params['primary'] = 1;
                        $params['billing'] = 0;
                        $params['shipping'] = 0;
                        break;

                    case 1: // Billing
                        $params['primary'] = 0;
                        $params['billing'] = 1;
                        $params['shipping'] = 0;
                        break;

                    case 2: // Shipping
                        $params['primary'] = 0;
                        $params['billing'] = 0;
                        $params['shipping'] = 1;
                        break;
                }

                $vendor_address_id = (isset($request->get('vendor_address_id')[$index])) ? 
                
                    $request->get('vendor_address_id')[$index] : null;

                VendorAddress::updateOrCreate(['id' => $vendor_address_id], $params);

            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return $e->getMessage();

        }

        return VendorAddress::where('vendor_id', $vendor_id)->get();

    }

}