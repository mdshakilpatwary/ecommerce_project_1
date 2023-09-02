<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;


class BrandController extends Controller
{
    function index(){
        return view('backend.brand.index');
    }
    // store part controller 
    function store(Request $request){

        $request->validate([
            'brand_name' => 'required',
            
        ],
        [
            'brand_name.required' => 'Unit name is required',
           
        ]);
    
        $brand = New Brand;

        $brand->brand_name = $request->brand_name;
        $brand->brand_description = $request->brand_desc;

        $insert = $brand->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }

    }
    // show all brand controller  
    function show(){
        $brand_data =Brand::orderBy('id', 'DESC')->get();
        return view('backend.brand.manage',compact('brand_data'));
    }

    // brand delete controller part 
    function destroy($id){
        $brand =Brand::find($id);

        $msg = $brand->delete();
        if($msg){
            return redirect()->back()->with('success', 'Data delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Data not delete');

        }   
    }

    // brand edit controller part 
    function edit($id){
        $brand_data =Brand::find($id);
        return view('backend.brand.edit',compact('brand_data'));
    }
// brand update controller part
function update(Request $request, $id){
    $brand =Brand::find($id);

    $brand->brand_name = $request->brand_name;
    $brand->brand_description = $request->brand_desc;


    $insert = $brand->update();
    if($insert){
        return redirect('/show/brand')->with('success', 'Successfully data Updated');

    }
    else{
        return redirect()->back()->with('error', 'Opps! data not Update');

    }
}

function changestatus($id){
    $status =Brand::find($id);
    if($status->status == 1){
       $status->update(['status' => 0]);
       return redirect()->back()->with('success', 'Brand Inactive successfully Done');
    }
    else{
        $status->update(['status' => 1]);
        return redirect()->back()->with('success', 'Brand Active successfully done');
    }
}

}
