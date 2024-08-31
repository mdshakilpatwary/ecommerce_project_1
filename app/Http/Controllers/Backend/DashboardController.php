<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\SiteInfo;
use File;
use Image;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;



class DashboardController extends Controller
{
    public $p_user;

    // for dashboard permission auth
         public function __construct() {
            $this->middleware(function($request, $next){
                $this->p_user =Auth::user();
                return $next($request);
    
            }) ;
        }

    // Dashboard manage method 
    function index(){
        $customer = User::Where('role', 'User')->get();
        $products = Product::Where('Status',1)->get();
        $order = Order::all();
        $total_income = Order::sum('total');
        // weekly income 
        $startOfWeek = now()->startOfWeek()->format('Y-m-d H:i:s');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d H:i:s');
        $totalIncomeWeek  = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total');
        // monthly income 
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $totalIncomeCurrentMonth = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total');
        // yearly income 
        $startYear = Carbon::now()->startOfYear();
        $endYear = Carbon::now()->endOfYear();
        $totalIncomeCurrentYear = Order::whereBetween('created_at', [$startYear, $endYear])->sum('total');
        $highestOrder = Order::min('total');
        // monthwise heigh order 
        $highestIncomes = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('MIN(total) as total')
        )->whereYear('created_at', now()->year)->groupBy(DB::raw('MONTH(created_at)'))->get();
        // monthwise total order 
        $totalIncomesmonthwise = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total) as total')
        )->whereYear('created_at', now()->year)->groupBy(DB::raw('MONTH(created_at)'))->get();

        // monthwise Lowest order 
        $lowestIncomes = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('MAX(total) as total')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy(DB::raw('MONTH(created_at)'))->get();

        return view('backend.dashboard',compact('customer','products','order','total_income','totalIncomeWeek','totalIncomeCurrentMonth','totalIncomeCurrentYear','highestIncomes','lowestIncomes','highestOrder','totalIncomesmonthwise'));

    }
    function profile(){
        if (is_null($this->p_user) || !$this->p_user->can('profile.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
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
        if (is_null($this->p_user) || !$this->p_user->can('profile.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }

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
        if (is_null($this->p_user) || !$this->p_user->can('profile.view')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        return view('backend.info.changePassword');
    }
    function updatePassword(Request $rqst, $id){
        if (is_null($this->p_user) || !$this->p_user->can('profile.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
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
            if (is_null($this->p_user) || !$this->p_user->can('siteinfo.edit')) {
                abort(403, 'Sorry !! You are Unauthorized to create any role !');
            }
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
            
            $msg =$info->update();
            if($msg){
                return back()->with('success','Site Info Updated successfully');
        
            }
            else{
                return back()->with('error','Opps! Site Info not Updated ');
            }
        
           
        
        }




}

