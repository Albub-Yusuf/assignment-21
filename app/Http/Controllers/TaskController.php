<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function addTask(Request $request){

        $email = $request->header('email');
        $userId = $request->header('id');

        try{

            Task::create([
                'task' => $request->input('task'),
                'status' => $request->input('status'),
                'user_id' => $userId
            ]);

            return response()->json(['status'=>'success','message'=>'Task added successfully!'],200);

        }catch(Exception $e){
            return response()->json(['status'=>'failed','message'=>'something went wrong!']);
        }


    }

    function taskList(Request $request){
        $email = $request->header('email');
        $userId = $request->header('id');
    }

    function updateTask(Request $request){
        $email = $request->header('email');
        $userId = $request->header('id');
    }

    function deleteTask(Request $request){
        $email = $request->header('email');
        $userId = $request->header('id');
    }
}
