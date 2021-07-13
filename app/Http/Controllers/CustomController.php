<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomController extends Controller
{
    public function __construct()
    {
        // $this->middleware(function ($request, $next){
            // if (Session::has('user_info') && $request->url() != url('custom_logout')) {
                // dd(Session::all(), Session::has('user_info'));
                // return redirect('/users');
            // }
        //     return $next($request);
        // });

    }

    public function custom_login()
    {
        // dd(Session::all(),$_SESSION);
        return view('custom.login');
    }

    public function student_login()
    {
        // dd(Session::all(),$_SESSION);
        return view('custom.login-student');
    }

    public function teacher_login()
    {
        // dd(Session::all(),$_SESSION);
        return view('custom.login-teacher');
    }

    public function principal_login()
    {
        // dd(Session::all(),$_SESSION);
        return view('custom.login-principal');
    }

    public function custom_register()
    {
        return view('custom.register');
    }

    public function registration_submit(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // dd($request->all());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Session::put('user_info', $user);
        Auth::login($user);

        return redirect()->route('users');

        // return redirect()->back()->with('success', 'user registration success');
    }

    public function login_submit(Request $request)
    {
        $this->validate($request, [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->first();
            if (Hash::check($request->password, $user->password)) {
                Session::put('user_info', $user);
                Auth::login($user);
                // dd(Session::all());
                return redirect()->route('users');
                // return redirect()->back()->with('success','login success.');
            } else {
                return redirect()->back()->with('error', 'password error.');
            }
        } else {
            return redirect()->back()->with('error', 'email error.');
        }
    }

    public function multiple_login_submit($request, $type, $page)
    {
        if (User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->first();
            if (Hash::check($request->password, $user->password)) {
                // dd($page,$user,session()->all());
                Session::put($type, $user);
                return redirect($page);
            } else {
                return redirect()->back()->with('error', 'password error.');
            }
        } else {
            return redirect()->back()->with('error', 'email error.');
        }
    }

    public function login_teacher_submit(Request $request)
    {
        $this->validate($request, [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        return $this->multiple_login_submit($request, 'user_teacher_info' , '/teachers');
    }

    public function login_student_submit(Request $request)
    {
        $this->validate($request, [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        return $this->multiple_login_submit($request, 'user_student_info' , '/students');
    }

    public function login_principal_submit(Request $request)
    {
        $this->validate($request, [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        return $this->multiple_login_submit($request, 'user_principal_info' , '/principals');
    }

    public function custom_logout()
    {
        Session::forget('user_info');
        Auth::logout();
        return redirect()->route('custom_login');
    }

    public function custom_teacher_logout()
    {
        Session::forget('user_teacher_info');
        Auth::logout();
        return redirect()->route('teacher_login');
    }

    public function custom_student_logout()
    {
        Session::forget('user_student_info');
        Auth::logout();
        return redirect()->route('student_login');
    }

    public function custom_principal_logout()
    {
        Session::forget('user_principal_info');
        Auth::logout();
        return redirect()->route('principal_login');
    }
}
