<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserVerification;
use App\Models\User;
use App\Models\Status;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class UserVerificationController extends Controller
{

    public function verifyAccount($token){

        /*
        |--------------------------------------------------------------------------
        | Default message and set datetime
        |--------------------------------------------------------------------------
        */

        $message = 'Sorry your email cannot be identified.';

        $datetime = now();

        /*
        |--------------------------------------------------------------------------
        | Validate Token
        |--------------------------------------------------------------------------
        */

        if ( ! UserVerification::where('token', $token)->exists() ){

            $message = 'Token not found, try requesting the token again.';
        }

        /*
        |--------------------------------------------------------------------------
        | Get user through relationship with UserVerification
        |--------------------------------------------------------------------------
        */
        
        $verifyUser = UserVerification::where('token', $token)->first();

        // using relatinship to get user instance

        $user = $verifyUser->user;

        // check to see if the user is not null

        if ( ! isset($user->status_id) ) {

            return ['message' => 'User not found'];

        }


        $status_id = Status::getStatusId('active'); 

        /*
        |--------------------------------------------------------------------------
        | confirm user exists and finish verification
        |--------------------------------------------------------------------------
        */

        if ( User::where('id', $user->id)->exists()  ){

                    // if the user does not have active status

                    if ( $user->status_id != $status_id ) {

                            $user->status_id = $status_id;
                            $user->email_verified_at = $datetime;
                            $user->save();

                            // remove token

                            $token = UserVerification::where('user_id', $user->id)->first();
                            $token->delete();

                            $message = "Your e-mail is verified. You may now login.";

                    } else {

                            /*
                            |--------------------------------------------------------------------------
                            | Clean up if user already has active status
                            |--------------------------------------------------------------------------
                            */

                            // make sure datetime in email_verified_at is set

                            if ( is_null($verifyUser->email_verified_at)){

                                $user->email_verified_at = $datetime;
                                $user->save();


                            }

                            $message = "Your e-mail is already verified. You may now login.";

                            $user_id = $user->id;

                            // delete token

                            $token = UserVerification::where('user_id', $user_id)->first();

                            $token->delete();

                    }
        }

        /*
        |--------------------------------------------------------------------------
        | Browser Feedback
        |--------------------------------------------------------------------------
        */

        return ['message' => $message];
        
    }

    public function requestVerificationToken(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | Set Values
        |--------------------------------------------------------------------------
        */

        $email = $request->email;

        $user = User::where('email', $email)->first();

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        if(!isset($user)){

            return ['message' => 'your email was not found in our system', 401];
        }

        if (! is_null($user->email_verified_at )){

            return ['message' => 'You are already verified', 201];
        }

        // need to check if token already exists, if so delete

        $token = Str::random(64);

        $user_id = $user->id;

        if ( UserVerification::where('user_id', $user_id)->exists() ){

            $oldToken = UserVerification::where('user_id', $user_id)->first();

            $oldToken->delete();

        }

        /*
        |--------------------------------------------------------------------------
        | Create User Verification record to store new token
        |--------------------------------------------------------------------------
        */

        UserVerification::create([
                    'user_id' => $user->id, 
                    'token' => $token
        ]);

        $email = $user->email;

        /*
        |--------------------------------------------------------------------------
        | Send email with new token
        |--------------------------------------------------------------------------
        */

        Mail::to($email)->send(new VerifyEmail($token));

        /*
        |--------------------------------------------------------------------------
        | Browser Feedback
        |--------------------------------------------------------------------------
        */

        return ['message' => 'email has been sent', 201];


    }
}
