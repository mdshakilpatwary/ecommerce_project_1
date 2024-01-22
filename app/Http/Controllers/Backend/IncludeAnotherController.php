<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\IncludeAnother;


class IncludeAnotherController extends Controller
{
    function index(){
        $id = 1 ;
        $data = IncludeAnother::find($id);
        return view('backend.include_another.index',compact('data'));
        

    }
    // store part controller 
    function update(Request $request, $id){

        $request->validate([
            'shipping_charge_insite' => [
                'integer',
                'nullable',
                'min:0',
            ],
            'shipping_charge_outsite' => [
                'integer',
                'nullable',
                'min:0',
            ],
            'tax_vat' => [
                'integer',
                'nullable',
                'max:100',
                'min:0',
            ],
            
        ]);
        $includeA =IncludeAnother::findOrFail($id);

        $includeA->shipping_charge_insite = $request->shipping_charge_insite;
        $includeA->shipping_charge_outsite = $request->shipping_charge_outsite;
        $includeA->tax_vat = $request->tax_vat;

        $insert = $includeA->update();
        if($insert){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }

    }
}
