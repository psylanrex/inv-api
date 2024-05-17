<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\PasswordResetFormService;
use App\Services\Auth\RequestPasswordResetTokenService;
use App\Services\Auth\ResetPasswordService;


class PasswordResetController extends Controller
{
    public function requestPasswordResetToken(Request $request, RequestPasswordResetTokenService $service)
    {

        $request->validate([

            'username' => 'required|string'

        ]);

       return $service->requestResetToken($request); 

    }

    public function getPasswordResetForm($token, PasswordResetFormService $service)
    {

        return $service->getPasswordResetForm($token);

    }


    public function passwordReset(Request $request, ResetPasswordService $service)
    {

        return $service->passwordReset($request);

    }

}
