<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalAccessToken;

class LoginService
{ 

    public function handleLogin($fields)
    {
        // get user by username

        $columns = [

            'User.id',
            'User.username',
            'User.password',    

        ];

        $user = User::select($columns)
                     
            ->where('username', $fields['username'])
                            
            ->first();

        // check user is valid and password matches

        if ( ! isset($user) || ! Hash::check($fields['password'], $user->password) ) {

            return response([

                'message' => 'Bad credentials'

            ], 401);

        }

        // set user_id

        $user_id = $user->id;

        // clear out any old access tokens

        if ( PersonalAccessToken::where('tokenable_id', $user_id)->exists() ){

            PersonalAccessToken::where('tokenable_id', $user_id)->delete();

        }

        // create new access token

        $token = $user->createToken('invitorytoken')->plainTextToken; 

        // format response data

        $responseData = [

            'user' => $user,
            'token' => $token
            
        ];

        // feedback to the browser

        return response($responseData, 201);

    }

}
