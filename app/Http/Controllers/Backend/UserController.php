<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Str;


class UserController extends Controller
{
    public $p_user;

    // for admin permission auth
         public function __construct() {
            $this->middleware(function($request, $next){
                $this->p_user =Auth::user();
                return $next($request);
    
            }) ;
        }
      // role and permission view 
      function index(){
        if (is_null($this->p_user) || !$this->p_user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any user !');
        }
        $roles  = Role::all();
                
        return view('backend.user.index',compact('roles'));
    }
    function userManage(){
        if (is_null($this->p_user) || !$this->p_user->can('admin.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any user !');
        }
        $users =user::all();
        return view('backend.user.manage',compact('users'));
    }


    // role store method
    function store(Request $request){
        if (is_null($this->p_user) || !$this->p_user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any user !');
        }
        $request->validate([
            'name' => ['required','max:100'],
            'email' => ['required','email','max:100','unique:users'],
            'password' => 'required|min:6',
            'con_password' => 'required|same:password',
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->username =Str::slug($request->name);
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        if($request->role){
            
            $done = $user->assignRole($request->role);
            if($done){
                $user->role ='Admin';
            }
            
        }

        $msg = $user->save();

        if($msg){
            return redirect('/user/manage')->with('success','User successfullu created');

        }
        else{
            return redirect()->back()->with('error', 'Opps! Your user Not created');

        }

    }

    // role edit method 
    function userEdit($id){
        if (is_null($this->p_user) || !$this->p_user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
        $user = User::findOrFail($id);
        $roles  = Role::all();

         return view('backend.user.edit',compact('user','roles'));
    }

    // role update method
    function userUpdate(Request $request,$id){
        if (is_null($this->p_user) || !$this->p_user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }

        $request->validate([
            'name' => ['required','max:100'],
            'email' => ['required','email','max:100'],
            'password' => 'nullable|min:6',
            'con_password' => 'nullable|same:password',
        ]);


        $user =User::findOrFail($id);
        $user->name = $request->name;
        $user->username =Str::slug($request->name);
        $user->email = $request->email;
        if($request->password){
            $user->password =Hash::make($request->password);
        }
        $user->roles()->detach();
        if($request->role){
            
            $done = $user->assignRole($request->role);
            if($done){
                $user->role ='Admin';

            }
            
        }

        $msg = $user->update();

        if($msg){
            return redirect('/user/manage')->with('success','User successfully Updated');

        }
        else{
            return redirect()->back()->with('error', 'Opps! Your user Not update');

        } 
   
    }

    function userDelete($id){
        if (is_null($this->p_user) || !$this->p_user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any user !');
        }
        $user = User::findOrFail($id);
        $msg = $user->delete();
        if($msg){
            return redirect()->back()->with('success', 'Successfully User Delete');

        }
        else{
            return redirect()->back()->with('error', 'Opps! User Not Delete');

        }
    }
}
