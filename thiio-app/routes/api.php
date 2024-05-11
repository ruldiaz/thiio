<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\userController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/users', [userController::class, 'index']);

Route::get('/users/{id}', [userController::class, 'show']);

Route::post('/users', [userController::class, 'store']);

Route::post('/login', [AuthController::class, 'login']);

Route::put('/users/{id}', [userController::class, 'update']);

Route::patch('/users/{id}', [userController::class, 'updatePatch']);

Route::delete('/users/{id}', [userController::class, 'destroy']);


// only authenticated user
Route::middleware('auth:sanctum')->group(function(){
  Route::get('/user', [AuthController::class,'user']);
  Route::post('/logout', [AuthController::class,'logout']);
});
