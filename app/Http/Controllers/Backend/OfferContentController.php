<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferDealContent;
use File;
use Image;
use Carbon\Carbon;

class OfferContentController extends Controller
{
    // view index file 
    public function index(){
        $offerData =OfferDealContent::all();
        if(count($offerData) > 0){
            $offerDealData = OfferDealContent::findOrFail(1);
            return view('backend.offerContent.index',compact('offerDealData'));

        }
        else{

            return view('backend.offerContent.index');
        }
    }

    // offer content store file 
    public function store(Request $request){
        $request->validate([
            'offer_heading' => [
                'required',
                'max:70',
            ],
            'offer_content' => [
                'required',
                'max:120',
            ],
            'offerimage1' => 'required',
            'offerimage2' => 'required',
            'offer_start_date' => [
                'required',
                'date',
                'after_or_equal:today', 
                'before:'. now()->addDays(30)->toDateString(), 
                'after:'.Carbon::now(), 
                
             ],
            'offer_end_date' => [
                'required',
                'date',
                'after_or_equal:today', 
                'before:'.Carbon::parse($request->offer_start_date)->addDays(30)->toDateString(), 
                'after:'.$request->offer_start_date,
                
             ],
            
        ],
        [
            'c.required' => 'Offer heading is required',
            'offer_content.required' => 'Offer content is required',
            'offerimage1.required' => 'Image 01 is required',
            'offerimage2.required' => 'Image 02 is required',
            'offer_start_date.required' => 'Start date select is required',
            'offer_start_date.before' => 'Offer start date must be within 1 month ',

            'offer_end_date.required' => 'Start date select is required',
            // 'offer_end_date.before' => 'Offer end date must be within 1 month ',
            
           
        ]);

        $offersave =new OfferDealContent;
        $offersave->offer_heading =$request->offer_heading;
        $offersave->offer_content =$request->offer_content;
        $offersave->offer_duration_start =$request->offer_start_date;
        $offersave->offer_duration_end =$request->offer_end_date;

 //  image1 store 
        if($request->file('offerimage1')){
            $image = $request->file('offerimage1');
            $customname='offer_'.rand().'.'. $image->getClientOriginalExtension();
            $offersave->image1 = $customname;
            $path_1 = public_path('uploads/offer_banner/'.$customname);
            Image::make($image)->resize(300, 300)->save($path_1);        }
        
     
 //  image2 store 

        if($request->file('offerimage2')){
            $image_2 = $request->file('offerimage2');
            $customname2='offer_'.rand().'.'. $image_2->getClientOriginalExtension();
            $offersave->image2 = $customname2;
            $path_2 = public_path('uploads/offer_banner/'.$customname2);
            Image::make($image_2)->resize(300, 300)->save($path_2);        }
       $msg =$offersave->save();
       if($msg){
        return redirect()->back()->with('success', 'Offer Content Successfully Added');

       }
       else{
        return redirect()->back()->with('error', 'Offer Content Not Added');

       }

    }

    // offer content update file 
    public function update(Request $request){
        $offersave =OfferDealContent::findOrFail(1);
        $request->validate([
            'offer_heading' => [
                'required',
                'max:70',
            ],
            'offer_content' => [
                'required',
                'max:120',
            ],
            'offer_start_date' => [
                'required',
                'date',
                'after_or_equal:today', 
                'before:'. now()->addDays(30)->toDateString(), 
                'after:'.Carbon::now(), 
                
             ],
            'offer_end_date' => [
                'required',
                'date',
                'after_or_equal:today', 
                // 'before:'.Carbon::parse($request->offer_start_date)->addDays(30)->toDateString(), 
                'after:'.$request->offer_start_date,
                
             ],
            
        ],
        [
            'c.required' => 'Offer heading is required',
            'offer_content.required' => 'Offer content is required',
            'offerimage1.required' => 'Image 01 is required',
            'offerimage2.required' => 'Image 02 is required',
            'offer_start_date.required' => 'Start date select is required',
            'offer_start_date.before' => 'Offer start date must be within 1 month ',

            'offer_end_date.required' => 'Start date select is required',
            // 'offer_end_date.before' => 'Offer end date must be within 1 month ',
            
           
        ]);

        
        $offersave->offer_heading =$request->offer_heading;
        $offersave->offer_content =$request->offer_content;
        $offersave->offer_duration_start =$request->offer_start_date;
        $offersave->offer_duration_end =$request->offer_end_date;

 //  image1 update 
        if($request->file('offerimage1')){
            if(File::exists(public_path('uploads/offer_banner/' .$offersave->image1))){
                File::delete(public_path('uploads/offer_banner/' .$offersave->image1));
            }          
            $image = $request->file('offerimage1');
            $customname='offer_'.rand().'.'. $image->getClientOriginalExtension();
            $offersave->image1 = $customname;
            $path_1 = public_path('uploads/offer_banner/'.$customname);
            Image::make($image)->resize(300, 300)->save($path_1);        
        }
        
     
 //  image2 update 

        if($request->file('offerimage2')){
            if(File::exists(public_path('uploads/offer_banner/' .$offersave->image2))){
                File::delete(public_path('uploads/offer_banner/' .$offersave->image2));
            }
            $image_2 = $request->file('offerimage2');
            $customname2='offer_'.rand().'.'. $image_2->getClientOriginalExtension();
            $offersave->image2 = $customname2;
            $path_2 = public_path('uploads/offer_banner/'.$customname2);

            Image::make($image_2)->resize(350, 350)->save($path_2);        

        }
       $msg =$offersave->update();
       if($msg){
        return redirect()->back()->with('success', 'Offer Content Successfully Updated');

       }
       else{
        return redirect()->back()->with('error', 'Offer Content Not Update');

       }

    }

    public function durationset(){

        $offerData =OfferDealContent::all();
        if(count($offerData) > 0){
            $offerDealData =OfferDealContent::findOrFail(1);

            // Set the offer start and end dates
            $offerStartDate = Carbon::now(); // Current date and time
            $offerEndDate = Carbon::parse($offerDealData->offer_duration_end);

            // Calculate the difference
            $diff = $offerStartDate->diff($offerEndDate);

            // Get the difference components
            $days = $diff->days;
            $hours = $diff->h;
            $minutes = $diff->i;
            $seconds = $diff->s;

            return response()->json([
                'offerenddate' => $offerEndDate,
                'offerDay' => $days,
                'offerHours' => $hours,
                'offerMinutes' => $minutes,
                'offerSeconds' => $seconds,
               
            ]);
        }
        else{
            // 
        }

    }



    
}
