<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }else {
            return view('admin.auth.login');
        }
    }

    public function register (Request $request)
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }else {
            return view('admin.auth.register');
        }
    }

    public function forgot()
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }else {
            return view('admin.auth.forgot');
        }
    }

    public function reset(Request $request, $token)
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }else {
            return view('admin.auth.reset')->with(['token' => $token, 'email' => $request->email]);
        }
    }
}
