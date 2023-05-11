<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReminderController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/',[LoginController::class,'index']);
Route::post('/login-process',[LoginController::class,'login_process']);
Route::get('/register',[LoginController::class,'register']);
Route::post('/register-process',[LoginController::class,'register_process']);

Route::group(['middleware'=>"checkLogin"],function (){
    Route::post('reminder/destroy',[ReminderController::class,'destroy']);
    Route::resource('reminder',ReminderController::class);
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
});
