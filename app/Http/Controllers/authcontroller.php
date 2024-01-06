<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authcontroller extends Controller
{
    // loginpage
    public function loginpage(){
        return view('login');
    }

    // registerpage
    public function registerpage(){
        return view('register');
    }

    // auth (admin or user)
    public function auth(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }

}
