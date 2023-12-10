<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\KgLitter;


class SizeController extends Controller
{
    function index(){
        return view('backend.size.index');
    }

    // size store controller
    function store(Request $request){

        $request->validate([
            'size' => 'required',
            
        ]);

        $size = New Size;
        $size->size =$request->size;
        $insert = $size->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }

    }

    // Data show controller 
    function show(){
        $size_data =Size::orderBy('id', 'DESC')->get();
        $kg_data =KgLitter::orderBy('id', 'DESC')->get();
        return view('backend.size.manage',compact('size_data','kg_data'));
    }

    
    // size delete controller part 
    function destroy($id){
        $size =Size::find($id);

        $msg = $size->delete();
        if($msg){
            return redirect()->back()->with('success', 'Data delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Data not delete');

        }   
    }

        // size edit controller part 
        function edit($id){
            $size_data =Size::find($id);
            return view('backend.size.edit',compact('size_data'));
        }

        // size update controller part
            function update(Request $request, $id){
                $size =Size::find($id);
                $size->size =$request->size;
                $insert = $size->update();
                if($insert){
                    return redirect('/show/size')->with('success', 'Successfully data Updated');

                }
                else{
                    return redirect()->back()->with('error', 'Opps! data not Update');

                }
}

// size status part 

function changestatus($id){
    $status =Size::find($id);
    if($status->status == 1){
       $status->update(['status' => 0]);
       return redirect()->back()->with('success', 'Size Inactive successfully Done');
    }
    else{
        $status->update(['status' => 1]);
        return redirect()->back()->with('success', 'Size Active successfully done');
    }
}

// kg ba litter part 
    // kg store controller
    function kgstore(Request $request){

        $request->validate([
            'kg_litter' => 'required',
            
        ]);

        $kg = New KgLitter;
        $kg->kg_litter =$request->kg_litter;
        $msg = $kg->save();
        if($msg){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }

    }
    
    // size delete controller part 
    function kgdestroy($id){
        $kg =KgLitter::find($id);

        $msg = $kg->delete();
        if($msg){
            return redirect()->back()->with('success', 'Data delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Data not delete');

        }   
    }

        // kg edit controller part 
        function kgedit($id){
            $kg_data =KgLitter::find($id);
            return view('backend.size.kgEdit',compact('kg_data'));
        }

        // kg update controller part
            function kgupdate(Request $request, $id){
                $kg =KgLitter::find($id);
                $kg->kg_litter =$request->kg_litter;
                $msg = $kg->update();
                if($msg){
                    return redirect('/show/size')->with('success', 'Successfully data Updated');

                }
                else{
                    return redirect()->back()->with('error', 'Opps! data not Update');

                }
}

// kg status part 

function kgchangestatus($id){
    $status =KgLitter::find($id);
    if($status->status == 1){
       $status->update(['status' => 0]);
       return redirect()->back()->with('success', 'Size Inactive successfully Done');
    }
    else{
        $status->update(['status' => 1]);
        return redirect()->back()->with('success', 'Size Active successfully done');
    }
}

}
