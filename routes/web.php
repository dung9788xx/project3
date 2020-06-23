<?php

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

Route::get('/', "HomeController@index");
Route::get('/admin', function (){
    return "ADMIN";
})->name('admin')->middleware("auth:admin");
Route::get('/user', function (){
    return "user";
})->name('user')->middleware("auth:user");
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
Route::post('/login', "AuthController@login")->name("login");
Route::get('/login', "AuthController@index")->name("login");
Route::post('/logout', "AuthController@logout")->name("logout");
