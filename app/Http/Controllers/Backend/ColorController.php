<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;


class ColorController extends Controller
{
    
    function index(){
        return view('backend.color.index');
    }

    // Color store controller
    function store(Request $request){

        $request->validate([
            'color' => 'required',
            
        ]);

        $color = New Color;
        $color->color =$request->color;
        $insert = $color->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }

    }

    // color data show controller 
    function show(){
        $color_data =Color::orderBy('id', 'DESC')->get();
        return view('backend.color.manage',compact('color_data'));
    }

    
    // color delete controller part 
    function destroy($id){
        $color =Color::find($id);

        $msg = $color->delete();
        if($msg){
            return redirect()->back()->with('success', 'Data delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Data not delete');

        }   
    }

        // color edit controller part 
        function edit($id){
            $color_data =Color::find($id);
            return view('backend.color.edit',compact('color_data'));
        }

        // color update controller part
            function update(Request $request, $id){
                $color =Color::find($id);
                $color->color =$request->color;
                $insert = $color->update();
                if($insert){
                    return redirect('/show/color')->with('success', 'Successfully data Updated');

                }
                else{
                    return redirect()->back()->with('error', 'Opps! data not Update');

                }
}

// color status part 

function changestatus($id){
    $status =Color::find($id);
    if($status->status == 1){
       $status->update(['status' => 0]);
       return redirect()->back()->with('success', 'Color Inactive successfully Done');
    }
    else{
        $status->update(['status' => 1]);
        return redirect()->back()->with('success', 'Color Active successfully done');
    }
}


}
