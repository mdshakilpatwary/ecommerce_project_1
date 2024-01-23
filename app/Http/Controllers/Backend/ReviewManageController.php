<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class ReviewManageController extends Controller
{
    public function index(){
        $reviewAll =ProductReview::orderBy('id', 'DESC')->get();
        return view('backend.review_all.manage_review',compact('reviewAll'));
    }
    public function viewsingleproduct($id){
        $reviewAll =ProductReview::where('product_id',$id)->orderBy('id', 'DESC')->get();
        return view('backend.review_all.viewSingleProductReview',compact('reviewAll'));
    }
    public function destroy($id){
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
