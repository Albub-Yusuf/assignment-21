<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        //return $hasUser->id;
        
        if($hasUser !==null){
            $token = JWTToken::CreateToken($request->input('email'),$hasUser->id);
            $response = response()->json([
                'status' => 'success',
                'message' => 'User Login Successful!'
            ],200);

            return Redirect::to('/dashboard')->withCookie(cookie('token', $token, 60 * 60 * 24));            
          
            
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

      //  echo "inside dashboard controller";

      $email = $request->header('email');
      $uid = $request->header('id');

      return ['email'=>$email,'uid'=>$uid];


    }
}
