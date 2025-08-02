<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    
    public function post(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            $fakultas = Auth::user()->fakultases->first();
            if (is_null($fakultas)) {
                return redirect()->route('setting.index');
            }
            return redirect()->route('dashboard.index', compact('fakultas'));
        }
        
        return redirect()->back()->withErrors(['failed' => 'Email atau password salah']);
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
