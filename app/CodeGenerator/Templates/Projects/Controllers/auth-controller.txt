<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Services\Auth\RegistrationService;
use App\Services\Auth\LoginService;
use DB;


class AuthController extends Controller
{

    public function register(RegistrationRequest $request, RegistrationService $register)
    {

        $fields = $request->all();

        return $register->handleRegistration($fields);   

    }

    public function login(Request $request, LoginService $service)
    {

        $fields = $request->validate([
            
            'email' => 'required|string',
            'password' => 'required|string'

        ]);

        return $service->handleLogin($fields);

    }

    public function logout(Request $request)
    {

        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];

    }

    public function loginCheck(Request $request)
    {

        $request->validate([

            'token' => 'string|required'

        ]);

        $token = $request->get('token');


        return  DB::table('personal_access_tokens')->where('token', $token)->exists();

    }

}

