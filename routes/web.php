<?php

use App\Http\Controllers\Backend\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->namespace('Backend')->middleware(['auth'])->group(function(){
    Route::get('/', [PageController::class, 'index']);
});

require __DIR__.'/auth.php';
