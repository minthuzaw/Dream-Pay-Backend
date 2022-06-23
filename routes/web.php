<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {

});

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboards', PageController::class);

    Route::resource('admins-management', AdminController::class);

    Route::resource('users-management', UserController::class);

});


require __DIR__ . '/auth.php';
