<?php

namespace App\Services\Auth;
use App\Models\User;
use App\Models\PersonalAccessToken;

class ImpersonateService
{
    public function handleImpersonate($request)
    {

        $vendor_id = $request->get('vendor_id');

        $password = $request->get('password');

        // harcoding employee password for now
        // because of app key issue

        $employee_password = "@whateverfloatsyourboat!!";

        // manual validation of employee for now
        // replace this code when we have the app key issue sorted out

        if ( $password != $employee_password ){

            return response([

                'message' => 'Bad credentials'

            ], 401);

        }

        // set user_id

        $user = User::where('vendor_id', $vendor_id)->first();

        $user_id = $user->id;


        // clear out any old access tokens

        if ( PersonalAccessToken::where('tokenable_id', $user_id)->exists() ){

            PersonalAccessToken::where('tokenable_id', $user_id)->delete();

        }

        // create new access token

        $token = $user->createToken('invitorytoken')->plainTextToken; 

        return response([

            'user' => $user,
            'token' => $token,
            'is_employee' => TRUE,
            'message' => 'Impersonating user'

        ], 200);

    }

}