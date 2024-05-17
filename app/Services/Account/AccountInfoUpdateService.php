<?php

namespace App\Services\Account;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountInfoUpdateService
{

    public function updateInfo($request)
    {

        $vendor_id = auth()->user()->vendor_id;

        $user = User::find(Auth::user()->id);

        $vendor = Vendor::find($vendor_id);

        // Start transaction!
        
        DB::beginTransaction();

        try {

            // Update the vendors company information

            $vendor->name = $request->get('name');
            $vendor->accepts_returns = $request->get('returns');
            $vendor->category_id = (int) $request->get('category_id');

            if ( $request->filled('website') ) {

                $vendor->website = $request->get('website');

            }

            $vendor->save();

            // Update the password if it is present

            if ( $request->filled('password') ) {

                $user->password = bcrypt($request->get('password'));

                $user->save();

            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return $e->getMessage();

        }

        return [
            
            $user, 
            $vendor
        
        ];

    }

}