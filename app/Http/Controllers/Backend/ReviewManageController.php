<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class ReviewManageController extends Controller
{
    public $p_user;

    // for review permission auth
         public function __construct() {
            $this->middleware(function($request, $next){
                $this->p_user =Auth::user();
                return $next($request);
    
            }) ;
        }

    public function index(){
        if (is_null($this->p_user) || !$this->p_user->can('review.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view reviews!');
        }
        $reviewAll =ProductReview::orderBy('id', 'DESC')->get();
        return view('backend.review_all.manage_review',compact('reviewAll'));
    }
    public function viewsingleproduct($id){
        if (is_null($this->p_user) || !$this->p_user->can('review.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view reviews!');
        }
        $reviewAll =ProductReview::where('product_id',$id)->orderBy('id', 'DESC')->get();
        return view('backend.review_all.viewSingleProductReview',compact('reviewAll'));
    }
    public function destroy($id){
        if (is_null($this->p_user) || !$this->p_user->can('review.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete reviews!');
        }
        $reviewAll =ProductReview::findOrFail($id);
        $msg =$reviewAll->delete();
        if($msg){
            return redirect()->back()->with('success','Review successfully delete');
        }
        else{
            return redirect()->back()->with('error','Review not delete');

        }
    }
}
