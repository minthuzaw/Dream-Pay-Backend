<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);

Route::middleware('auth:api')->group(function(){
   Route::get('profile', [AuthApiController::class, 'profile']);
   Route::put('pin', [UserApiController::class, 'pin']);
});
