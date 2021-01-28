<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // dd('abc');
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);
        if(Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->intended(route('admin'));
        } 
        return redirect()->intended(route('show-login'));
    }
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('show-login');
    }
}
