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
        $category = New Category;

        $category->cat_name = $request->cat_name;
        if($request->file('cat_image')){
            $image = $request->file('cate_image');
            $customeName=rand().'.'. $image->getClientOriginalExtension();
            $image->move('uploads/category', $customeName);
            $category->cat_image = $customeName;
        }

        $insert = $category->save();
        if($insert){
            return redirect()->back()->with('success', 'Successfully data Submitted');

        }
        else{
            return redirect()->back()->with('error', 'Opps! data not Submitted');

        }

    }
}
