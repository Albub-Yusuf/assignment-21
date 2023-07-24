<?php

namespace App\Http\Controllers;

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
}
