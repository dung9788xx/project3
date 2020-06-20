<?php

use Illuminate\Http\Request;

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
Route::get('/admins', "HomeController@index");
Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});
Route::namespace("Api")->group(function (){
   Route::post('users/signin', "LoginController@login");
    Route::post('admins/signin', "LoginController@login");
});
