<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
