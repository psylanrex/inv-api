<?php

namespace App\Services\Auth;

use App\Services\Auth\RegistrationTransactionService;

class RegistrationService
{

    public function handleRegistration($request)
    {

        $user = (new RegistrationTransactionService)->createUser($request);

        $fields = [

            'username' => $user->username,
            'password' => $user->password

        ];

        // create new access token

        $token = $user->createToken('invitorytoken')->plainTextToken; 

        return response([

            'user' => $user,
            'token' => $token,
            'message' => 'User created'

        ], 201);

    }
       
}