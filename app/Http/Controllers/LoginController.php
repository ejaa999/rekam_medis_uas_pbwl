<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request){
        if(Auth::check()){
            $this->logout($request,FALSE);
        }

        return view('login');
    }

    
    public function authenticate(Request $request)
    {
        $credentials['username'] = $request->input('username');
        $credentials['password'] = $request->input('password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(auth()->user()->visibility == 0){
                $this->logout($request,FALSE);
                return redirect()->back()->with('danger','Akun telah dihapus');
            }else{
                return redirect()->intended('/');
            }
        }

        return redirect()->back()->with('danger','Login gagal, harap coba lagi');
    }

    public function logout(Request $request, $redirect_to_login = TRUE)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if($redirect_to_login){
            return redirect('/login');
        }
    }
}
