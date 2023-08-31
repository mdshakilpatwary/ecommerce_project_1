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
            'cat_name.required' => 'Category name is required',
           
        ]);
    
        $category = New Category;

        $category->cat_name = $request->cat_name;
        if($request->file('cat_image')){
            $image = $request->file('cat_image');
            $customname='cat_'.rand().'.'. $image->getClientOriginalExtension();
            $category->cat_image = $customname;
            if($category->save()){
                $image->move('uploads/category', $customname);

            }
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
    function destroy($id){
        $cat_destroy =Category::find($id);
        if(File::exists(public_path('uploads/category/' .$cat_destroy->cat_image))){
            File::delete(public_path('uploads/category/' .$cat_destroy->cat_image));
        }
        $msg = $cat_destroy->delete();
        if($msg){
            return redirect()->back()->with('success', 'Data delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Data not delete');

        }   
    }
    function edit($id){
        $cat_data =Category::find($id);
        return view('backend.category.edit',compact('cat_data'));
    }
    function update(Request $request, $id){
        $category =Category::find($id);

        $category->cat_name = $request->cat_name;
        if($request->file('cat_image')){

            if(File::exists(public_path('uploads/category/' .$category->cat_image))){
                File::delete(public_path('uploads/category/' .$category->cat_image));
            }
            $image = $request->file('cat_image');
            $customname='cat_'.rand().'.'. $image->getClientOriginalExtension();
            $image->move('uploads/category', $customname);
            $category->cat_image = $customname;
        }

        $insert = $category->update();
        if($insert){
            return redirect('/show/catagory')->with('success', 'Successfully data Updated');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Update');

        }
    }
    function changestatus($id){
        $status =Category::find($id);
        if($status->cat_status == 1){
           $status->update(['cat_status' => 0]);
           return redirect()->back()->with('success', 'Category status successfully change');
        }
        else{
            $status->update(['cat_status' => 1]);
            return redirect()->back()->with('success', 'Category status successfully change');
        }
    }

}
