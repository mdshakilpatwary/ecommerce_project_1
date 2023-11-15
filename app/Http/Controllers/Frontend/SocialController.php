<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Image;
use File;

class SocialController extends Controller
{
    public function create(){
        return Socialite::driver('google')->redirect();
    }
    public function login(){

        $googleuser = Socialite::driver('google')->user();
 
        $myUser = User::where('social_id',$googleuser->id)->first();
        if(!empty($myUser)){
            Auth::login($myUser);
 
            return redirect('/dashboard');
        }
        else{
            $user =new User;
            $user->name = $googleuser->name;
            $user->email = $googleuser->email;
            $user->social_id = $googleuser->id;
            $user->pic =$googleuser->avatar;
            $user->update();
            $sid = $googleuser->id;
            return view('frontend.page.setpassword', compact('sid'));
            // Auth::login($user);
 
            // return redirect('/dashboard');
        }

    }

    public function setpass(Request $request, $sid){
        $request->validate([
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ],
        [
            'password.required' => 'password required and minimum 6 carechter',
            'cpassword.required' => 'confirmation password is invalid',
        ]);

        $find = User::where('social_id', $sid)->first();
        $find->password = $request->password;
        $find->save();
        Auth::login($find);
        // $notice = array(
        //     'type' => 'success',
        //     'message' => 'Successfully set password'
        // );
 
        return redirect('/dashboard');

    }



}
