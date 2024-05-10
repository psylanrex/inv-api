<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Https\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\Status;
use DB;

class LoginService
{



    public function handleLogin($fields)
    {

        // Check email and get user

        $user = User::where('users.email', $fields['email'])->first();

        // Check user is valid and password matches

        if ( ! isset($user) || ! \Illuminate\Support\Facades\Hash::check($fields['password'], $user->password) ) {

            return response([
                'message' => 'Bad credentials'
            ], 401);

        }

        // set user_id

        $user_id = $user->id;

        // get status ids

        $pendingEmailVerificationStatus = Status::getStatusId('pending_email_verification');

        $dumpedStatus = Status::getStatusId('dumped');

        // if user is dumped

        if ( $user->status_id == $dumpedStatus) {

            return response([
                'message' => 'Bad credentials'
            ], 401);

        }

        // get rid of old verification token if it exists

        if ( UserVerification::where('user_id', $user->id)->exists() ){

            $oldToken = UserVerification::where('user_id', $user->id)->first();

            $oldToken->delete();

        }

        // if not verified, create new token

        if ( is_null($user->email_verified_at) ){

            //  confirm email

            $token = Str::random(64);


            UserVerification::create([
                    'user_id' => $user_id, 
                    'token' => $token
            ]);

            // we're stil in the if block, send the verification token

            $email = $user->email;

            Mail::to($email)->send(new VerifyEmail($token));

            return response([
                'message' => 'Please verify your account.'
            ], 201);
        }

        // clear out any old access tokens

        if ( DB::table('personal_access_tokens')->where('tokenable_id', $user_id)->exists() ){

            DB::table('personal_access_tokens')->where('tokenable_id', $user_id)->delete();    

        }

        // create new token

        $app_name = env('APP_NAME');

        $token = $user->createToken($app_name)->plainTextToken;


        // format response data

        $responseData = [
            'user' => $user,
            'token' => $token
        ];

        // feedback to the browser

        return response($responseData, 201);

    }






}