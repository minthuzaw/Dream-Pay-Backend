<?php

use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);

Route::middleware('auth:api')->group(function(){
   Route::get('profile', [AuthApiController::class, 'profile']);
});
