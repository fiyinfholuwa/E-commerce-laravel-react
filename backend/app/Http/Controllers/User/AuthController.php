<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(Request $request){
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;
                return response([
                    "mesage" => "Login succesffuly",
                    "user" => $user,
                    "token" => $token
                ], 200);
            }
            
        } catch (Exception $exception) {
            return response([
                "message" => $exception->getMessage()
            ], 400); //state code
        }
        return response([
            "message" => "Invalid email or password"
        ], 401);
    }

    public function Register(Request $request){
        try {
            $validateData = $request->validate([
                "name" => "required| max:55",
                "email" => "required|unique:users|min:5| max:55",
                "password" => "required|min:6|confirmed"
            ]);
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);
          
            $token = $user->createToken('app')->accessToken;
            return response([
                "mesage" => "Register Successfully",
                "user" => $user,
                "token" => $token
            ], 200 );

        } catch (Exception $exception) {
            return response([
                "message" => $exception->getMessage()
            ], 400); //state code
        }
    }
}
