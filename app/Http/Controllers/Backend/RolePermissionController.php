<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RolePermissionController extends Controller
{   
    public $p_user;

// for role permission auth
     public function __construct() {
        $this->middleware(function($request, $next){
            $this->p_user =Auth::user();
            return $next($request);

        }) ;
    }


    // role and permission view 
    function index(){
        if (is_null($this->p_user) || !$this->p_user->can('role.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        $all_permissions  = Permission::all();
        $permission_groups = User::getpermissionGroups();        
        return view('backend.role_and_permission.index',compact('permission_groups','all_permissions'));
    }
    function rolePermissionManage(){
        if (is_null($this->p_user) || !$this->p_user->can('role.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $roles =Role::all();
        return view('backend.role_and_permission.manage',compact('roles'));
    }


    // role store method
    function store(Request $request){
        if (is_null($this->p_user) || !$this->p_user->can('role.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        $request->validate([
            'name' => ['required','unique:roles','max:100'],
            'permissions' => ['required'],
        ]);


        $role = Role::create(['name' => $request->name]);
        
        $permissions = $request->permissions;

        if(!empty($permissions)){
            $role->syncPermissions($permissions);

        }
        return redirect('/role/permission/manage')->with('success','Role and Permission successfullu created');




    }

    // role edit method 
    function rolePermissionEdit($id){
        if (is_null($this->p_user) || !$this->p_user->can('role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        $role = Role::findById($id);
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();       
         return view('backend.role_and_permission.edit',compact('role','all_permissions','permission_groups'));
    }

    // role update method
    function rolePermissionUpdate(Request $request,$id){
        if (is_null($this->p_user) || !$this->p_user->can('role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        $request->validate([
            'name' => ['required','max:100'],
            'permissions' => ['required'],
        ]);


        $role = Role::findById($id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->update();
            $role->syncPermissions($permissions);
        }
        return redirect('/role/permission/manage')->with('success','Role and Permission successfullu created');
   
    }

    function rolePermissionDelete($id){
        if (is_null($this->p_user) || !$this->p_user->can('role.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }
        $role = Role::findById($id);
        $msg = $role->delete();
        if($msg){
            return redirect()->back()->with('success', 'Successfully Your Role Delete');

        }
        else{
            return redirect()->back()->with('error', 'Opps! Your Role Not Delete');

        }
    }

}
