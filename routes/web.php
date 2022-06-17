<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->namespace('Backend')->middleware(['auth'])->group(function(){
//    Route::get('/', [PageController::class, 'index']);
});

Route::middleware(['auth'])->group(function (){
    Route::resource('dashboards', PageController::class);
    Route::resource('admins-management', AdminController::class);
});


require __DIR__.'/auth.php';
