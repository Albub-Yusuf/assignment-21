<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TokenVerificationMiddleware;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user-registration',[UserController::class,'userRegistration']);

Route::post('user-login',[UserController::class,'userLogin']);

Route::get('user-logout',[UserController::class,'userLogout']);

Route::get('/dashboard',[UserController::class,'dashboard'])->middleware(TokenVerificationMiddleware::class);



// Todo Routes

Route::post('add-task',[TaskController::class,'addTask'])->middleware(TokenVerificationMiddleware::class);

Route::get('/tasks',[TaskController::class,'taskList'])->middleware(TokenVerificationMiddleware::class);

Route::get('/show-task/{id}',[TaskController::class,'showSingleTask'])->middleware(TokenVerificationMiddleware::class);

Route::post('/update-task/{id}',[TaskController::class,'updateTask'])->middleware(TokenVerificationMiddleware::class);

Route::post('/delete-task/{id}',[TaskController::class,'deleteTask'])->middleware(TokenVerificationMiddleware::class);





