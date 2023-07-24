<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function userRegistration(Request $request){

        try{

            User::create([
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password'))
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
        $userPassword = User::where('email',$request->input('email'))->select('password')->get();
        
        $hasUser = User::where('email',$request->input('email'))
                        ->where('password',Hash::check($request->input('password'),$userPassword))
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

    function dashboard(Request $request){

      $userId = $request->header('id');

      $name = User::where('id',$userId)->select('firstName','lastName')->first();

      return response()->json([
        'status'=>'success',
        'message'=>'welcome to myTodoApp Dashboard - '.$name->firstName." ".$name->lastName
      ]);


    }
}
