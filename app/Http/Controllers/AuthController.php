<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->remember == 'on' ? true : false;
        $check = Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember);
        if (!$check){
            return redirect()->route('getLogin');
        }else{
            return redirect()->route('getDashboard');
        }
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
