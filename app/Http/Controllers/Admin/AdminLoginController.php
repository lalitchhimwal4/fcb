<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminLoginController extends Controller
{
    //admin login frontend
    public function Login()
    {
        if (Auth::check()) {
            return Redirect::route('admin.dashboard');
        }
        return view('admin.login');
    }

    //admin checklogin details
    public function CheckLogin(Request $request)
    {
        if (Auth::check()) {
            return Redirect::route('admin.dashboard');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // $credentials['roleid'] = 1;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect::intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function Logout()
    {
        Auth::logout();
        return Redirect::route('admin.login');
    }
}
