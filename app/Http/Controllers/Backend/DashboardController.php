<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SiteInfo;
use File;
use Image;
use Illuminate\Support\Str;



class DashboardController extends Controller
{
    function index(){
        return view('backend.dashboard');

    }
function profile(){
    $id = 1;
    $siteInfo = SiteInfo::find($id);
    return view('backend.info.profile', compact('siteInfo'));
}
    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    // profile update controller
    function profileUpdate(Request $rqst, $id){
        $user = User::find($id);
        
        $user->name = $rqst->name;
        $user->username =Str::slug($rqst->name);
        $user->email = $rqst->email;
        $user->phone = $rqst->phone;
        $user->birth = $rqst->birth;
        $user->address = $rqst->address;
        $user->country = $rqst->country;
        $user->description = $rqst->description;
        $user->facebook = $rqst->facebook;
        if($rqst->file('image')){
            
            if(File::exists(public_path('uploads/user/' .$user->image))){
                File::delete(public_path('uploads/user/' .$user->image));
            }
            $image = $rqst->file('image');
            $customName = rand().'.'.$image->getClientOriginalExtension();
            $path = public_path('uploads/user/'. $customName);
            Image::make($image)->resize(300,300)->save($path);
            $user->image = $customName ;
            
        }
        
        $msg =$user->save();
        if($msg){
            return back()->with('success','Profile Updated successfully');
    
        }
        else{
            return back()->with('error','Opps! Profile not Updated ');
        }
    
       
    
    }

    // change password 

    function changePassword(){
        return view('backend.info.changePassword');
    }
    function updatePassword(Request $rqst, $id){
        $userpass = User::find($id);
        $rqst->validate([
            'oldPass' => 'required',
            'newPass' => 'required',
            'conPass' => 'required|same:newPass',
        ],
        [
            'oldPass.require' => 'Your old password is required',
            'newPass.require' => 'Your new password is required',
            'conPass.require' => 'Your confirm password is required',
        ]);

        $oldPass = $rqst->oldPass;
        $userOldpass = $userpass->password;
        if(Hash::check($oldPass, $userOldpass)){
            $userpass->password = bcrypt($rqst->newPass);
            $userpass->update();
           
            return back()->with('success','Password successfully changed');


        }
        else{
          
            return back()->with('error','old password not match');


        }
       
    }

        // Site Info update controller
        function siteInfoUpdate(Request $rqst, $id){
            $info = SiteInfo::find($id);
            
            $info->name = $rqst->name;
            $info->email = $rqst->email;
            $info->phone = $rqst->phone;
            $info->address = $rqst->address;
            $info->description = $rqst->description;
            if($rqst->file('main_logo')){
                
                if(File::exists(public_path('uploads/info/' .$info->main_logo))){
                    File::delete(public_path('uploads/info/' .$info->main_logo));
                }
                $image = $rqst->file('main_logo');
                $customName = rand().'.'.$image->getClientOriginalExtension();
                $path = public_path('uploads/info/'. $customName);
                Image::make($image)->resize(300,300)->save($path);
                $info->main_logo = $customName ;
                
            }
            if($rqst->file('footer_logo')){
                
                if(File::exists(public_path('uploads/info/' .$info->footer_logo))){
                    File::delete(public_path('uploads/info/' .$info->footer_logo));
                }
                $fimage = $rqst->file('footer_logo');
                $customName = rand().'.'.$fimage->getClientOriginalExtension();
                $path = public_path('uploads/info/'. $customName);
                Image::make($fimage)->resize(300,300)->save($path);
                $info->footer_logo = $customName ;
                
            }
            
            $msg =$info->save();
            if($msg){
                return back()->with('success','Site Info Updated successfully');
        
            }
            else{
                return back()->with('error','Opps! Site Info not Updated ');
            }
        
           
        
        }




}

