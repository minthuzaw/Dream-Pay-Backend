<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::put('pin', [AuthController::class, 'updatePin']);
//   Route::put('levelup', [UserController::class, 'levelup']);
    Route::get('recipient', [UserController::class, 'getRecipient']);
    Route::post('transfer', [TransactionController::class, 'transfer']);
    Route::get('transactions', [TransactionController::class, 'index']);
});
