<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\ImpersonateRequest;
use App\Services\Auth\RegistrationService;
use App\Services\Auth\LoginService;
use App\Services\Auth\ImpersonateService;
use App\Models\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request, RegistrationService $register)
    {

        return $register->handleRegistration($request->all());

    }

    public function login(Request $request, LoginService $service)
    {

        $fields = $request->validate([
            
            'username' => 'required|string',
            'password' => 'required|string'

        ]);

        return $service->handleLogin($fields);

    }

    public function logout(Request $request)
    {

        $user_id = auth()->Id();

        // delete all tokens for user       

        PersonalAccessToken::where('tokenable_id', $user_id)->delete();

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


        return  PersonalAccessToken::where('token', $token)->exists();

    }

    public function permissionDenied()
    {

        return ['message' => 'Permission denied'];

    }

    public function impersonateVendor($id)
    {

        // takes in vendor id to foward to form

        return ['vendor_id' => $id];

    }

    public function impersonate(ImpersonateRequest $request, ImpersonateService $service)
    {

        return $service->handleImpersonate($request);

    }
      
}
