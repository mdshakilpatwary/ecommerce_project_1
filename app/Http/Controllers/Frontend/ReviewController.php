<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    // review store 
    public function storeReview(Request $request){
        
            $review = new ProductReview;
            $review->product_id = $request->review_product_id;
            $review->user_id = Auth::user()->id;
            $review->name = $request->review_name;
            $review->email = $request->review_email;
            $review->review = $request->review;
            $review->rating = $request->review_rating;
            $review->created_at = Carbon::now();
            $msg = $review->save();

        
        
            if($msg){
                return response()->json([
                    'status' => 'ok',
                    'message' => 'Review submitted successfully',    
                ]);
            }
            else{
                return response()->json([
                    'status' => 'not ok',
                    'message' => 'Review not saved ',    
                ]);
            }
        

    }
    // review delete 
    public function showReview($id){
        $showAll = ProductReview::where('product_id',$id)->orderBy('id', 'DESC')->get();
        $review_count = count($showAll);
        return response()->json([
            'reviewdata' => $showAll,    
            'review_count' => $review_count,    
        ]);

    }
    public function deleteReview(){}


}



