<?php

namespace App\Services\Account;

use App\Models\VendorContact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateContactsService
{

    public function updateContacts($request)
    {

        $vendor_id = auth()->user()->vendor_id;

        // Start transaction!
        
        DB::beginTransaction();

        try {

            foreach ($request->get('first_name') AS $index => $value) {

                // Build the update / create params array

                $params = [

                    'vendor_id' => auth()->user()->vendor_id,
                    'first_name' => $request->get('first-name')[$index],
                    'last_name' => $request->get('last-name')[$index],
                    'title' => $request->get('title')[$index],
                    'department' => $request->get('department')[$index],
                    'phone' => $request->get('phone')[$index],
                    'cell' => $request->get('mobile')[$index],
                    'fax' => $request->get('fax')[$index],
                    'email' => $request->get('email')[$index],
                    'create_user_id' => Auth::user()->id,
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_user_id' => Auth::user()->id,
                    'update_time' => date('Y-m-d H:i:s')

                ];

                $vendor_contact_id = (isset($request->get('vendor_contact_id')[$index])) ? 
                
                    $request->get('vendor_contact_id')[$index] : null;

                VendorContact::updateOrCreate(['id' => $vendor_contact_id], $params);

            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return $e->getMessage();

        }

        return VendorContact::where('vendor_id', $vendor_id)->get();

    }

}