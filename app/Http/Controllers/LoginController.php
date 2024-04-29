<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    //

    public function login(Request $request){
        // dd('hello'); 
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if(auth()->attempt($loginData)){

            $request->session()->regenerate();
            
            return redirect('/dashboard');

            
        }

        else{

            return "not loggede in";
        }

        
    }
    
    public function logout(Request $request)
    {
        Auth::logout(); // Clear the authenticated user's session
        return redirect('/');
    }
}
