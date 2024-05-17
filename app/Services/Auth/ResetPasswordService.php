<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\PasswordReset;
use App\Models\VendorContact;
use Illuminate\Support\Facades\DB;

class ResetPasswordService
{

    public function passwordReset($request)
    {

        $request->validate(['password' => 'required|string|confirmed',
                            'vendor_id' => 'required|integer',
                            'token' => 'required|string']);

        $passwordReset = PasswordReset::where('token', $request->token)->first();

        $id = $request->vendor_id;

        $user = User::where('vendor_id', $id)->first();

        $email = VendorContact::where('vendor_id', $id)->value('email');

        if ( ! $passwordReset->email == $email ) {

            return ['message' => 'invalid credentials', 401];
        }

        $password = bcrypt($request->password);

        // eloquent wouldn't update password, had to use DB

        DB::table('User')

            ->where('vendor_id', $id)
              
            ->update(['password' => $password]);

        // delete token

        $oldToken = $request->token;

        if ( PasswordReset::where('token', $oldToken)->exists() ){

            $oldToken = PasswordReset::where('token', $oldToken)->first();

            $oldToken->delete();

        }

        return ['message' => 'Your Password has been updated', 201];

    }

}