<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
Route::middleware("auth:admin-api")->get('/admins', function (){
    return Auth::user();
});
Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});
Route::namespace("Api")->group(function (){
   Route::post('users/signin', "LoginController@usersLogin");
    Route::post('admins/signin', "LoginController@login");
});
