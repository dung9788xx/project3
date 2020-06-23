<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }
    public function logout(){
        Auth::logout();
        return view("auth.login");
    }

    public function login(Request $request)
    {

        if(Auth::guard("admin")->attempt(["email"=>$request["email"],"password"=>$request["password"]])){
            $token=Auth::guard("admin")->user()->createToken("Login token")->accessToken;
            echo $token;
        }else{
            return view("auth.login");
        }
    }
}
