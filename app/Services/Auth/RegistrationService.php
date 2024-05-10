<?php

namespace App\Services\Auth;

use Illuminate\Https\Response;
use App\Models\User;
use App\Models\UserVerification;
use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;


class RegistrationService
{

    public function handleRegistration($fields)
    {

        $status_id = Status::getStatusId('pending_email_verification');

        // create the user

        $user = User::create([

            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'status_id' => $status_id

        ]);


        //  create verification token and send confirm email

        $token = Str::random(64);

        $user_id = $user->id;

        UserVerification::create([

                    'user_id' => $user_id, 
                    'token' => $token
        ]);


        Mail::to($user)->send(new VerifyEmail($token));

        // format response data

        $responseData = [
            'message' => 'please confirm your email',
            'user' => $user
        ];

        // feedback to the browser

        return response($responseData, 201);

    }

    

}