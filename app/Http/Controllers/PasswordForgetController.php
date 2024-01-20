<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Str;
use Hash;

class PasswordForgetController extends Controller
{
    public function forgetPassword(){
        return view('forget_password');
    }

    // reset password part 
    public function resetPassword(Request $request){
        $user = User::where('email','=',$request->email)->first();
        if(!empty($user)){
            
            $user->remember_token = Str::random(20);
            $user->save();
            Mail::to($user->email)->send(new ForgetPasswordMail($user));
            return redirect()->back()->with('success','Please check your email and reset your password');

        }
        else{
            return redirect()->back()->with('error','Email doesn\'t match please try again');
        }

        
    }
    // set password 
    public function setPassword($token){
        $user = User::where('remember_token','=',$token)->first();
        

        if(!empty($user)){

            return view('reset_password', compact('user'));
        }
        else{
            abort(404, 'Sorry !This page is not available for you!');
        }

    }
    public function updatePassword(Request $request,$token){
        $user = User::where('remember_token','=',$token)->first();
         $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ],
        [
            'password.require' => 'Your new password is required',
            'confirm_password.require' => 'Your confirm password is required',
        ]);
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(20);
        $msg =$user->update();
        if($msg){

            return redirect('login')->with('success','Password successfully changed');
        }
        else{         
            return back()->with('error','please try again');
        }

    }
    
}
