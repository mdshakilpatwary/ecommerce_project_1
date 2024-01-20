<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferDealContent;
use File;
use Image;

class OfferContentController extends Controller
{
    // view index file 
    public function index(){
        return view('backend.offerContent.index');
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
            'offer_start_date' => 'required',
            'offer_end_date' => 'required',
            
        ],
        [
            'c.required' => 'Offer heading is required',
            'offer_content.required' => 'Offer content is required',
            'offerimage1.required' => 'Image 01 is required',
            'offerimage2.required' => 'Image 02 is required',
            
           
        ]);

        // $offersave =new OfferDealContent;
        // $offersave->offersave =$request->offersave;
        // $offersave->offer_content =$request->offer_content;
        // $offersave->offer_duration_start =$request->offer_duration_start;
        // $offersave->offer_duration_end =$request->offer_duration_end;

    }

    // offer content update file 
    public function update(Request $request, $id){
        // 
    }
    
}
