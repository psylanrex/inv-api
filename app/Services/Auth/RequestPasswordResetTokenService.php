<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\PasswordReset;
use App\Models\VendorContact;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordEmail;

class RequestPasswordResetTokenService
{

    public function requestResetToken($request)
    {

        $user = User::where('username', $request->username)->first();

        if ( ! isset($user) ) {

            return ['message' => 'your username was not found in our system', 401];
        }

        // get the email address of user

        $email = VendorContact::where('vendor_id', $user->vendor_id)->value('email');

        // need to check if token already exists, if so delete


        if ( PasswordReset::where('email', $email)->exists() ){

            $oldToken = PasswordReset::where('email', $email)->first();

            $oldToken->delete();

        }

        $token = Str::random(64);

        PasswordReset::create([

            'email' => $email, 
            'token' => $token,
            'created_at' => now()

        ]);

        Mail::to($email)->send(new ForgotPasswordEmail($token));

        return ['message' => 'email has been sent', 201];

    }

}