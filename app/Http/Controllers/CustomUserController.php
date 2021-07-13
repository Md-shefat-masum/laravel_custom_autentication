<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomUserController extends Controller
{
    public function __construct()
    {
        // $this->middleware(function ($request, $next){
        //     if (Session::has('user_info')) {
        //         // dd(Session::all(), Session::has('user_info'));
        //         return $next($request);
        //     }else{
        //         return redirect('/custom-login');
        //     }
        // });

    }

    public function users()
    {
        // dd(session()->all());
        return view('custom.users');
    }

    public function teacher()
    {
        return view('custom.teacher');
    }

    public function student()
    {
        return view('custom.student');
    }

    public function principal()
    {
        return view('custom.principal');
    }
}
