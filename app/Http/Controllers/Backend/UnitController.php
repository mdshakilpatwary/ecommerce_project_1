<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    function index(){
        return view('backend.unit.index');
    }
    // store part controller 
    function store(Request $request){

        $request->validate([
            'unit_name' => 'required',
            
        ],
        [
            'unit_name.required' => 'Brand name is required',
           
        ]);
    
        $unit = New Unit;

        $unit->unit_name = $request->unit_name;
        $unit->unit_description = $request->unit_desc;

        $insert = $unit->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }

    }
    // show all brand controller  
    function show(){
        $unit_data =Unit::orderBy('id', 'DESC')->get();
        return view('backend.unit.manage',compact('unit_data'));
    }

    // Unit delete controller part 
    function destroy($id){
        $unit =Unit::find($id);

        $msg = $unit->delete();
        if($msg){
            return redirect()->back()->with('success', 'Data delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Data not delete');

        }   
    }

    // unit edit controller part 
    function edit($id){
        $unit_data =Unit::find($id);
        return view('backend.unit.edit',compact('unit_data'));
    }
// brand update controller part
function update(Request $request, $id){
    $unit =Unit::find($id);

    $unit->unit_name = $request->unit_name;
    $unit->unit_description = $request->unit_desc;


    $insert = $unit->update();
    if($insert){
        return redirect('/show/unit')->with('success', 'Successfully data Updated');

    }
    else{
        return redirect()->back()->with('error', 'Opps! data not Update');

    }
}
// unit status part 
function changestatus($id){
    $status =Unit::find($id);
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
