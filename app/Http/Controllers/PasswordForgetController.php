<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordForgetController extends Controller
{
    public function forgetPassword(){
        return view('forget_password');
    }
    public function resetPassword(Request $request){

        return view('');
    }
    
}
