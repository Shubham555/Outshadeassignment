<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Usercontroller;

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
    if(Auth::check())
    {
        return redirect('/dashboard');
    }
    else
    {
        return view('welcome');
    }
});


Route::get('/login',function(){
    if(Auth::check())
    {
        return redirect('/dashboard');
    }
    else
    {
        return view('auth.login');
    }
})->name('login');


Route::get('/register',function(){
    if(Auth::check())
    {
        return redirect('/dashboard');
    }
    else
    {
        return view('auth.register');
    }
})->name('register');

Route::post('/login',[AuthController::class,'logincheck'])->name('login');

Route::post('/register',[AuthController::class,'submituser'])->name('register');

Route::get('/logout',function(){
    if(Auth::check())
    {
        Auth::logout();
        return redirect('/login');
    }
})->name('logout');
Route::middleware('auth:sanctum','checkauth')->group(function(){
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard');
    Route::view('/manageprofile','User.Manageprofile')->name('manageprofile');
    Route::post('/changepassword',[Usercontroller::class,'changepassword'])->name('changepassword');
    Route::get('/createevent',[Usercontroller::class,'opencreateevent'])->name('createevent');
    Route::post('/createevent',[UserController::class,'createevent'])->name('createevent');
    Route::get('/eventupdate/{id}',[UserController::class,'eventupdate']);
    Route::post('updateevent',[UserController::class,'updateevent'])->name('updateevent');
});
   