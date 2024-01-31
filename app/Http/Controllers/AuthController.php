<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except'=>['register','login']]);
    }
    public function register (Request $request){

        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json([
            "message"=>"User created successfuly",
            "user"=>$user
        ],201);
    }

    public function login (Request $request){

        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        
        $token = JWTAuth::attempt([
            "email"=>$request->email,
            "password"=>$request->password,
        ]);

        if(!empty($token)){
            return response()->json([
                "tokenType"=>"Bearer",
                "access_token"=>$token,
                "user"=>auth()->user(),
                "expires_in"=>auth()->factory()->getTTL()*60,
                "message"=>"User logged in successfully",
            ],200);
        }

        return response()->json([
            "message"=>"Unauthorized"
        ], 401);
    }

    public function profile(){

        $userData = auth()->user();

        if(!empty($userData)){
            return response()->json([
                "message"=>"User informations",
                "user"=>$userData
            ], 200);
        }

        return response()->json([
            "message"=>"Unauthorized"
        ], 401);
    }

    public function refreshToken(){

        $newToken = auth()->refresh();

        if(!empty($newToken)){
            return response()->json([
                "message"=>"New access token generated",
                "token"=>$newToken,
                "expires_in"=>auth()->factory()->getTTL()*80,
            ],200);
        }
        
        return response()->json([
            "message"=>"Unauthorized"
        ], 401);
    }

    public function logout(){

        auth()->logout();

        return response()->json([
            "message"=>"User logged out successfully"
        ],200);
    }

    public function changePassword(Request $request){

        $validator=Validator::make($request->all(),[
            'old_password'=>'required',
            'password'=>'required|confirmed|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }

        $user = $request->user();

        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                "password"=>Hash::make($request->password)
            ]);
            return response()->json(["message"=>"Password successfully updated"], 200);
        }else{
            return response()->json(["message"=>"Old password doesn't matched"], 400);
        }

    }
}
