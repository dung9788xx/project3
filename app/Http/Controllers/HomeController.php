<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth:admin-api");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Auth::guard("admin-api")->user();
    }

    public function showHome()
    {
       echo "home";
    }

    public function showNews()
    {
        echo "news";
    }

    public function chanel()
    {
        echo "This is new Chanel brance";
    }

    public function CC()
    {
        
    }
}
