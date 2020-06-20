<?php

namespace App\Http\Controllers\Api;

use App\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function login(Request $request)
    {
        $params=$this->getParams($request);
        $validator=Validator::make($params,$this->rules());
        if($validator->fails()){
            return response()->json([
                "code"=>422,
                "message"=>$validator->errors()->first()
            ]);
        }
        $credential=[
            "email"=>$params["email"],
            "password"=>$params["password"]
        ];
        DB::connection()->enableQueryLog();
        if(Auth::guard("admin-api")->attempt($credential)){
            $user=Auth::guard("admin-api")->user();
            $token=$user->createToken("Login token")->accessToken;
            return response()->json([
                "code"=>200,
                "message"=>"Login success",
                "accessToken"=>$token
            ],200);
        }else{

            return response()->json([
                "code"=>402,
                "message"=>"Check email password"
            ],403);
        }
    }

    public function getParams(Request $request)
    {
        return $request->only([
            "email",
            "password"
        ]);
    }
    public function rules()
    {
        return [
            "email"=>"required|email",
            "password"=>"required"
        ];
    }

    public function cc()
    {
        dd(Auth::guard("admin-api")->user());
    }
}
