<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function userRegistration(Request $request){

        try{

            User::create([
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
                'password'=>$request->input('password')
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'User Registration Successful!'
            ],200);

        }catch(Exception $err){
            return response()->json([
                'status'=>'failed',
                'message'=>'something went wrong!',
                'error'=>$err
            ]);

        }   

    }

    function userLogin(Request $request){
        $hasUser = User::where('email',$request->input('email'))
                        ->where('password',$request->input('password'))
                        ->select('id')->first();
        
        if($hasUser !==null){
            $token = JWTToken::CreateToken($request->input('email'),$hasUser->id);
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful!'
            ],200)->cookie('token',$token,60*60*24);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>"unauthorized"
            ],401);
        }
    }

    function userLogout(){
        return redirect('/')->cookie('token','',-1);
    }
}
