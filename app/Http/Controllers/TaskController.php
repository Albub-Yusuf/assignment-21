<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function addTask(Request $request){

        
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
        
        $userId = $request->header('id');

        $tasks = Task::where('user_id',$userId)->get();
        return $tasks;
    }

    function showSingleTask(Request $request,$taskId){
      
        $userId = $request->header('id');

        $task = Task::where('user_id',$userId)->where('id',$taskId)->get();
        return $task;
     
    }

    function updateTask(Request $request,$taskId){
        
        $userId = $request->header('id');

       try{
        $result =  Task::where('user_id',$userId)->where('id',$taskId)
             ->update([
                'task'=>$request->input('task'),
                'status'=>$request->input('status')
                ]);
            
       if($result){
        return response()->json(['status'=>'success','message'=>'Task updated successfully!'],200);
       }else{
        return response()->json(['message'=>'This task is not associated with current user!'],401);
       }

       }catch(Exception $e){
            return response()->json(['status'=>'failed','message'=>'Something went wrong!']);
       }

    }

    function deleteTask(Request $request,$taskId){
       
        $userId = $request->header('id');

        try{
            $result =  Task::where('user_id',$userId)->where('id',$taskId)->delete();
                
           if($result){
            return response()->json(['status'=>'success','message'=>'Task deleted successfully!'],200);
           }else{
            return response()->json(['message'=>'This task is not associated with current user!'],401);
           }
    
           }catch(Exception $e){
                return response()->json(['status'=>'failed','message'=>'Something went wrong!']);
           }
    }
}
