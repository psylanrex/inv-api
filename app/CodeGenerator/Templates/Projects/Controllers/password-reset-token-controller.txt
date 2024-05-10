<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordResetToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordEmail;
use DB;


class PasswordResetTokenController extends Controller
{
    public function requestPasswordResetToken(Request $request){

        $user = User::where('email', $request->email)->first();

        if(!isset($user)){

            return ['message' => 'your email was not found in our system', 401];
        }

        // need to check if token already exists, if so delete


        if ( PasswordResetToken::where('email', $user->email)->exists() ){

            $oldToken = PasswordResetToken::where('email', $user->email)->first();

            $oldToken->delete();

        }

        $token = Str::random(64);

        PasswordResetToken::create([
                    'email' => $user->email, 
                    'token' => $token,
                    'created_at' => now()
        ]);

        $email = $user->email;

        Mail::to($email)->send(new ForgotPasswordEmail($token));

        return ['message' => 'email has been sent', 201];


    }

    public function getPasswordResetForm($token){

        $message = 'Sorry, we could not find your account.';


        if ( ! PasswordResetToken::where('token', $token)->exists() ){

            return ['message' => 'Something is wrong with your request', 401];
        }
        
        $passwordReset = PasswordResetToken::where('token', $token)->first();

        if ( ! is_null($passwordReset) ){

            // find and return user

                $requestUserEmail = $passwordReset->email;

                $user = User::where('email', $requestUserEmail)->first();

                return ['message' => 'User found', 'user_id' => $user->id, 'token' => $token, 201];
                    
        }

        return ['message' => $message];

    }

    public function passwordReset(Request $request){

        $request->validate(['password' => 'required|string|confirmed',
                            'user_id' => 'required|integer',
                            'token' => 'required|string']);

        $passwordReset = PasswordResetToken::where('token', $request->token)->first();

        $id = $request->user_id;

        $user = User::find($id)->first();

        if ( ! $passwordReset->email == $user->email ) {

            return ['message' => 'invalid credentials', 401];
        }

        $password = bcrypt($request->password);

        // eloquent wouldn't update password, had to use DB

        DB::table('users')
              ->where('id',$id )
              ->update(['password' => $password]);

        // delete token

        $oldToken = $request->token;

        if ( PasswordResetToken::where('token', $oldToken)->exists() ){

            $oldToken = PasswordResetToken::where('token', $oldToken)->first();

            $oldToken->delete();

        }

        return ['message' => 'Your Password has been updated', 201];

    }
}
