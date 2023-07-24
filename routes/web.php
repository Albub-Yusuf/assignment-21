<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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

