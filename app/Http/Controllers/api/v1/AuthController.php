<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    function signIn(Request $request){
        $data = $request->validate([
            "email"=>"required|email",
            "password"=>"required"]
        );

        if (Auth :: attempt($data)){
            $user = \auth()->user();
            $token = $user->createToken("ANDROID");

            return response()->json([
                'status'=>true,
                'message'=>'sign in success',
                "token"=>$token->plainTextToken
            ]);
        } else {
            return \response()->json([
                'status'=>false,
                'message'=>'sign in failed, check your credentials'
            ]);
        }
    }
    function signUp(Request $request){
        $data = $request->validate([
            "email"=>"required|email|unique:users,email",
            "password"=>"required",
            "name"=>"required|min:3"
        ]);

        $user = User :: create([
            'email'=>$data['email'],
            'password'=>Hash :: make($data['password']),
            'name'=>$data['name']
        ]);

        $token = $user->createToken("ANDROID");

        return \response()->json(['status'=>true, 'message'=>'sign up success' , 'token'=>$token->plainTextToken]);
    }
}
