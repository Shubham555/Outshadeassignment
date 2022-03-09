<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/reset-password/{id?}',[UserApiController::class,'get_reset_password']);
Route::post('/reset-password/',[UserApiController::class,'post_reset_password']);
Route::get('/listallevents',[UserApiController::class,'listallevents']);
Route::get('/listeventinvitation',[UserApiController::class,'listeventinvitation']);
Route::get('/search/{name?}',[UserApiController::class,'search']);
Route::get('/date/{filtertype?}',[UserApiController::class,'datefilter']);