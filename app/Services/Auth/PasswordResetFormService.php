<?php

namespace App\Services\Auth;

use App\Models\VendorContact;
use App\Models\PasswordReset;

class PasswordResetFormService
{

    public function getPasswordResetForm($token)
    {

        $message = 'Sorry, we could not find your account.';


        if ( ! PasswordReset::where('token', $token)->exists() ) {

            return ['message' => 'Something is wrong with your request', 401];

        }
        
        $passwordReset = PasswordReset::where('token', $token)->first();

        if ( ! is_null($passwordReset) ){

            // find and return user

                $requestUserEmail = $passwordReset->email;

                // need to look up the vendor_id of the user

                $vendor = VendorContact::where('email', $requestUserEmail)->first();

                return ['message' => 'Vendor found', 'vendor_id' => $vendor->id, 'token' => $token, 201];
                    
        }

        return ['message' => $message];

    }

}