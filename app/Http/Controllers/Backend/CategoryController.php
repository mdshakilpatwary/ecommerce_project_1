<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use File;
use Image;

class CategoryController extends Controller
{
    function index(){
        return view('backend.category.index');
    }

    function store(Request $request){

        $request->validate([
            'cat_name' => 'required',
            
        ],
        [
            'cat_name.required' => 'Category is required',
           
        ]);
    
        $category = New Category;

        $category->cat_name = $request->cat_name;
        if($request->file('cat_image')){
            $image = $request->file('cat_image');
            $customname='cat'.rand().'.'. $image->getClientOriginalExtension();
            $image->move('uploads/category', $customname);
            $category->cat_image = $customname;
        }

        $insert = $category->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }

    }

    function show(){
        $cat_data =Category::all();
        return view('backend.category.manage',compact('cat_data'));
    }
}
